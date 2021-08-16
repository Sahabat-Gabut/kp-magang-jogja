import * as yup from 'yup'

const FILE_SIZE = 5 * 1024 * 1024; // ~= 5 MB
const SUPPORTED_FORMATS_IMAGE = ["image/jpg", "image/jpeg", "image/gif", "image/png"];

const SUPPORTED_FORMATS_PDF = ["application/pdf"];
const SUPPORTED_FORMATS_PPT = ["application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation"];

const generalSchema = yup.object({
    agency: yup.string().required('Dinas harus diisi!'),
    university: yup.string().required('Universitas harus diisi!'),
    department: yup.string().required('Jurusan harus diisi!'),
    dateStart: yup.string().required('Rencana Mulai harus diisi!'),
    dateFinish: yup.string().required('Rencana Selesai harus diisi!'),
});

const schemaFiles = yup.object({
    coverLetter: yup.mixed()
        .required('Surat Pengantar dibutuhkan!')
        .test("isEmpty",
            "Surat Pengantar dibutuhkan!",
            (value) => value && value.file)
        .test("fileSize",
            "Ukuran file terlalu besar!",
            (value) => value && value.file && value.file.size <= FILE_SIZE)
        .test("fileFormat",
            "Format file tidak diperbolahkan!",
            (value) => value && value.file && SUPPORTED_FORMATS_PDF.includes(value.file.type)),
    proposal: yup.mixed()
        .required('Proposal dibutuhkan!')
        .test("isEmpty",
            "Proposal dibutuhkan!",
            (value) => value && value.file)
        .test("fileSize",
            "Ukuran file terlalu besar!",
            (value) => value && value.file && value.file.size <= FILE_SIZE)
        .test("fileFormat",
            "Format file tidak diperbolahkan!",
            (value) => value && value.file && SUPPORTED_FORMATS_PDF.includes(value.file.type)),
    presentation: yup.mixed()
        .required('PPT dibutuhkan!')
        .test("isEmpty",
            "PPT dibutuhkan!",
            (value) => value && value.file)
        .test("fileSize",
            "Ukuran file terlalu besar!",
            (value) => value && value.file && value.file.size <= FILE_SIZE)
        .test("fileFormat",
            "Format file tidak diperbolahkan!",
            (value) => value && value.file && SUPPORTED_FORMATS_PPT.includes(value.file.type)),
});

const schemaProject = yup.object({
    projectName: yup.string().required('Nama Projek harus diisi!'),
    projectDesc: yup.string().required('Deskripsi Projek harus diisi!'),
});

const schemaParticipants = yup.object({
    participants: yup.array().of(
        yup.object().shape({
            img: yup.mixed()
                .required('Pas foto dibutuhkan!')
                .test("isEmpty",
                    "Pas foto dibutuhkan!",
                    (value) => value && value.file)
                .test("fileSize",
                    "Ukuran file terlalu besar!",
                    (value) => value && value.file && value.file.size <= FILE_SIZE)
                .test("fileFormat",
                    "Format file tidak diperbolahkan!",
                    (value) => value && value.file && SUPPORTED_FORMATS_IMAGE.includes(value.file.type)),
            jss_id: yup.string().required('ID JSS harus diisi!'),
            npm: yup.string().required('NPM harus diisi!'),
            cv: yup.mixed()
                .required('CV dibutuhkan!')
                .test("isEmpty",
                    "CV dibutuhkan!",
                    (value) => value && value.file)
                .test("fileSize",
                    "Ukuran file terlalu besar!",
                    (value) => value && value.file && value.file.size <= FILE_SIZE)
                .test("fileFormat",
                    "Format file tidak diperbolahkan!",
                    (value) => value && value.file && SUPPORTED_FORMATS_PDF.includes(value.file.type)),
        })
    )
});

export {
    generalSchema,
    schemaFiles,
    schemaProject,
    schemaParticipants
}
