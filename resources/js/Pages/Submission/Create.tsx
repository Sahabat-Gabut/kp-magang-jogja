import React from "react";
import axios from 'axios';
import Swal from 'sweetalert2';
import {FieldArray, FormikValues} from 'formik';
import {generalSchema, schemaFiles, schemaParticipants,} from './formModel/schema';
import {useRoute, useTypedPage} from "@/Hooks";
import {SelectOptions} from "@/types";
import GuestLayout from "@/Layouts/GuestLayout";
import {
    FormikImage,
    FormikInput,
    FormikInputFile,
    FormikJSS,
    FormikSelect,
    FormikWizard,
    FormStep
} from '@/Components/Formik';

export default function Submission() {
    const {auth, options} = useTypedPage<{ options: SelectOptions[] }>().props;
    const route = useRoute();
    const initialValues = {
        agency: '',
        university: '',
        department: '',
        dateStart: '',
        dateFinish: '',
        coverLetter: {
            name: "",
            src: null,
            file: null,
        },
        proposal: {
            name: "",
            src: null,
            file: null,
        },
        presentation: {
            name: "",
            src: null,
            file: null,
        },
        // projectName: '',
        // projectDesc: '',
        participants: [
            {
                jss_id: auth.user?.id,
                npm: '',
                name: auth.user?.fullname,
                cv: {
                    name: "",
                    src: null,
                    file: null,
                },
                img: {
                    name: "",
                    src: null,
                    file: null,
                },
            }
        ]
    };

    const _onSubmit = (values: FormikValues) => {
        Swal.fire({
            title: 'Apakah data sudah benar?',
            text: "Harap periksa kembali formulir anda, sebelum mengirimkannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, sudah benar',
            cancelButtonText: 'Belum'
        }).then((result: any) => {
            if (result.isConfirmed) {
                axios.post(route('submission.store'), values)
                    .then(() => Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Selamat anda berhasil mendaftar!',
                    }))
                    .catch(() => Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Maaf terjadi kesalahan!',
                    }))
            }
        })
    }

    return (
        <>
            <div className="flex flex-col h-full">
                <div className="pt-16 pb-16 -mt-16 bg-fixed border-b"
                     style={{backgroundImage: 'url("/img/noisy_grid.png")'}}>
                    <div
                        className="container flex items-center justify-between max-w-screen-md px-5 py-16 mx-auto text-left md:px-0 lg:max-w-screen-xl">
                        <span className="text-lg font-semibold text-gray-700 md:text-2xl">Pendaftaran Magang</span>
                    </div>
                </div>

                <FormikWizard
                    initialValues={initialValues}
                    onSubmit={values => _onSubmit(values)}>

                    <FormStep
                        stepName="Informasi Umum"
                        validationSchema={generalSchema}>

                        <FormikSelect
                            label="Dinas"
                            name="agency"
                            options={options}
                            placeholder="Pilih Dinas..."/>

                        <div className="grid mt-2 md:grid-cols-2 md:grid-rows-2 md:gap-4">
                            <FormikInput id="university" label="Universitas" name="university"/>
                            <FormikInput id="department" label="Jurusan" name="department"/>

                            <FormikInput id="dateStart" label="Rencana Mulai" type="date" name="dateStart"/>
                            <FormikInput id="dateFinish" label="Rencana Selesai" type="date" name="dateFinish"/>
                        </div>
                    </FormStep>

                    <FormStep
                        stepName="Unggah Berkas"
                        validationSchema={schemaFiles}>
                        <FormikInputFile helperText="PDF dibawah 10Mb" accept=".pdf" type="file" label="Surat Pengantar"
                                         name="coverLetter"/>
                        <FormikInputFile helperText="PDF dibawah 10Mb" accept=".pdf" type="file" label="Proposal"
                                         name="proposal"/>
                        <FormikInputFile helperText="PPT dibawah 10Mb" accept=".ppt,.pptx" type="file"
                                         label="Presentasi yang akan diajukan" name="presentation"/>
                    </FormStep>

                    {/* <FormStep
                        stepName="Informasi Projek"
                        validationSchema={schemaProject}>
                        <InputField label="Nama Projek" name="projectName" />
                        <InputField label="Deskripsi Projek" name="projectDesc" />
                    </FormStep> */}

                    <FormStep
                        stepName="Informasi Peserta"
                        validationSchema={schemaParticipants}>
                        <div>
                            <div className="flex flex-col items-center md:flex-row">
                                <div className="mr-5 h-36 w-36">
                                    <FormikImage
                                        name="participants.0.img"
                                        label="upload image"
                                        type="file"
                                        accept=".jpeg, .jpg, .png"
                                        hidden={true}/>
                                </div>
                                <div className="w-full">
                                    <div className="flex flex-col justify-between gap-4 md:flex-row">
                                        <FormikInput label="ID JSS" name={`participants.0.jss_id`} readOnly={true}/>
                                        <FormikInput label="NPM" name={`participants.0.npm`}/>
                                    </div>
                                    <div className="flex flex-col justify-between gap-4 md:flex-row">
                                        <FormikInput label="Nama" name={`participants.0.name`} readOnly={true}/>
                                        <FormikInputFile helperText="PDF dibawah 10Mb" accept=".pdf" label="CV"
                                                         name={`participants.0.cv`} type="file"/>
                                    </div>
                                </div>
                            </div>

                            <FieldArray
                                name="participants"
                                render={helper => (
                                    <>
                                        {helper.form.values.participants.map((_: any, index: number) => (
                                            index > 0 && (
                                                <div key={index + 1} className="mt-5">
                                                    <div className="flex items-center justify-between">
                                                        <hr className="w-full mr-5 border-gray-400 border-dashed"/>
                                                        <button type="button"
                                                                className="block pb-1 text-sm font-semibold text-red-700 hover:text-red-900"
                                                                onClick={() => helper.remove(index)}>
                                                            Hapus
                                                        </button>
                                                    </div>
                                                    <div className="flex flex-col items-center md:flex-row">
                                                        <FormikImage
                                                            accept=".jpeg, .jpg, .png"
                                                            name={`participants.${index}.img`}/>
                                                        <div className="w-full">
                                                            <div
                                                                className="flex flex-col justify-between gap-4 md:flex-row">
                                                                <FormikJSS
                                                                    label="ID JSS"
                                                                    index={index}
                                                                    name={`participants.${index}.jss_id`}/>

                                                                <FormikInput label="NPM"
                                                                             name={`participants.${index}.npm`}/>
                                                            </div>
                                                            <div
                                                                className="flex flex-col justify-between gap-4 md:flex-row">
                                                                <FormikInput label="Nama"
                                                                             name={`participants.${index}.name`}
                                                                             readOnly={true}/>
                                                                <FormikInputFile helperText="PDF dibawah 10Mb" accept=".pdf"
                                                                                 label="CV"
                                                                                 name={`participants.${index}.cv`}
                                                                                 type="file"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            )))}
                                    </>
                                )}/>
                        </div>
                    </FormStep>

                    <FormStep
                        stepName="Review Formulir">
                        <div className="pb-10 mt-2">
                            <div className="px-5 py-2 mb-5 text-white border-l-4 border-green-600">
                                <span
                                    className="w-full text-lg font-semibold text-gray-700 uppercase">Informasi Umum</span>
                            </div>
                            <div className="px-5">
                                <div className="grid mt-2 md:grid-cols-2 md:grid-rows-2 md:gap-4">
                                    <FormikInput id="university" label="Universitas" name="university" readOnly={true}/>
                                    <FormikInput id="department" label="Jurusan" name="department" readOnly={true}/>

                                    <FormikInput id="dateStart" label="Rencana Mulai" type="date" name="dateStart"
                                                 readOnly={true}/>
                                    <FormikInput id="dateFinish" label="Rencana Selesai" type="date" name="dateFinish"
                                                 readOnly={true}/>
                                </div>
                            </div>
                        </div>

                        <div className="pb-10">
                            <div className="px-5 py-2 mb-5 text-white border-l-4 border-green-600">
                                <span className="w-full text-lg font-semibold text-gray-700 uppercase">Berkas Tim</span>
                            </div>
                            <div className="px-5">
                                <FormikInput label="Surat Pengantar" name="coverLetter.name" readOnly={true}/>
                                <FormikInput label="Proposal" name="proposal.name" readOnly={true}/>
                                <FormikInput label="Presentasi yang akan diajukan" name="presentation.name"
                                             readOnly={true}/>
                            </div>
                        </div>

                        <div className="pb-10">
                            <div className="px-5 py-2 mb-5 text-white border-l-4 border-green-600">
                                <span
                                    className="w-full text-lg font-semibold text-gray-700 uppercase">Informasi Projek</span>
                            </div>
                            <div className="px-5">
                                <FormikInput id="projectName" label="Nama Projek" name="projectName" readOnly={true}/>
                                <FormikInput id="projectDesc" label="Deskripsi Projek" name="projectDesc"
                                             readOnly={true}/>
                            </div>
                        </div>

                        <div className="">
                            <FieldArray
                                name="participants"
                                render={helper => (
                                    <>
                                        <div className="px-5 py-2 mb-5 text-white border-l-4 border-green-600">
                                            <span className="w-full text-lg font-semibold text-gray-700 uppercase">Informasi Peserta</span>
                                        </div>
                                        <div className="px-5">
                                            {helper.form.values.participants.map((_: any, index: number) => (
                                                <div key={index} className="mt-5">
                                                    <div className="flex items-center justify-between mb-2">
                                                        <span
                                                            className="w-24 mr-2 font-semibold text-gray-700 uppercase">peserta {index + 1}</span>
                                                        <hr className="w-full border-gray-300 border-dashed"/>
                                                    </div>
                                                    <div className="flex flex-col items-center md:flex-row">
                                                        <FormikImage name={`participants.${index}.img`}
                                                                     readOnly={true}/>
                                                        <div className="w-full">
                                                            <div
                                                                className="flex flex-col justify-between gap-4 md:flex-row">
                                                                <FormikInput label="NPM"
                                                                             name={`participants.${index}.jss_id`}
                                                                             readOnly={true}/>
                                                                <FormikInput label="NPM"
                                                                             name={`participants.${index}.npm`}
                                                                             readOnly={true}/>
                                                            </div>
                                                            <div
                                                                className="flex flex-col justify-between gap-4 md:flex-row">
                                                                <FormikInput label="Nama"
                                                                             name={`participants.${index}.name`}
                                                                             readOnly={true}/>
                                                                <FormikInput label="CV"
                                                                             name={`participants.${index}.cv.name`}
                                                                             readOnly={true}/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ))}
                                        </div>
                                    </>
                                )}
                            />
                        </div>
                    </FormStep>
                </FormikWizard>
                <div className="flex justify-center py-4 mt-auto font-semibold text-green-800">
                    Magang Dinas Kota Yogyakarta
                </div>
            </div>
        </>
    )

}

Submission.layout = (page: React.ReactChild) => <GuestLayout children={page} showFooter={false}/>;
