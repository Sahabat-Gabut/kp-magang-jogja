import React from 'react';
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
    const _onChange = (e: any) => {
        form.setData(data => ({...data, [e.target.key]: e.target.value}));
    };

    return (
        <>
            <Input name={'name'} label={'Nama Dinas'} value={form.data.name} onChange={_onChange}/>
            <Input name={'quota'} label={'Kuota Magang'} type={'number'} value={form.data.quota} onChange={_onChange}/>
            <Textarea name={'location'} label={'Lokasi Dinas'} value={form.data.location} onChange={_onChange}/>
            <div className={'flex justify-end mt-5'}>
                <SuccessButton onClick={() => form.put(route('agency.update', {id: form.data.id}))}>
                    Simpan
                </SuccessButton>
            </div>
        </>
    );
}

AgencyConfig.layout = (page: React.ReactChild) => <AppLayout children={page}/>;