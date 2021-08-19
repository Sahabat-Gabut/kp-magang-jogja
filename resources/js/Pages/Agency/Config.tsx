import React, {ChangeEvent} from 'react';
import AppLayout from "@/Layouts/AppLayout";
import {useRoute, useTypedPage} from "@/Hooks";
import {Agency} from "@/types";
import {Input, Textarea} from "@/Components/Form";
import {SuccessButton} from "@/Components/Button";
import {useForm} from "@inertiajs/inertia-react";

export default function AgencyConfig() {
    const {agency} = useTypedPage<{ agency: Agency }>().props;
    const route = useRoute();
    const form = useForm({
        id: agency.id,
        name: agency.name,
        location: agency.location,
        quota: agency.quota
    });
    const {setData, data} = form;
    const _onChange = (e: any) => {
        const key = e.target.name;
        const value = e.target.value;
        setData(data => ({...data, [key]: value}));
    };

    return (
        <>
            <Input name={'name'} label={'Nama Dinas'} value={data.name}
                   onChange={(e: ChangeEvent<HTMLInputElement>) => _onChange(e)}/>
            <Input name={'quota'} label={'Kuota Magang'} type={'number'} value={data.quota}
                   onChange={(e: ChangeEvent<HTMLInputElement>) => _onChange(e)}/>
            <Textarea name={'location'} label={'Lokasi Dinas'} defaultValue={data.location}
                      onChange={(e: ChangeEvent<HTMLTextAreaElement>) => _onChange(e)}/>
            <div className={'flex justify-end mt-5'}>
                <SuccessButton onClick={() => form.put(route('agency.update', {id: form.data.id}))}>
                    Simpan
                </SuccessButton>
            </div>
        </>
    );
}

AgencyConfig.layout = (page: React.ReactChild) => <AppLayout children={page}/>;