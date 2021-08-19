import {Form, Formik, FormikConfig, FormikHelpers, FormikValues} from 'formik';
import React, {useState} from 'react'

interface Props extends FormikConfig<FormikValues> {
    children: React.ReactNode;
}

const FormikWizard = ({children, initialValues, onSubmit}: Props) => {
    const [stepNumber, setStepNumber] = useState(0);
    const steps = React.Children.toArray(children) as React.ReactElement[];

    const [snapshot, setSnapshot] = React.useState(initialValues);

    const step = steps[stepNumber];
    const totalSteps = steps.length;
    const isLastStep = stepNumber === totalSteps - 1;

    const next = (values: FormikValues) => {
        setSnapshot(values);
        setStepNumber(stepNumber + 1);
    };

    const previous = (values: FormikValues) => {
        setSnapshot(values);
        setStepNumber(stepNumber - 1);
    };

    const handleSubmit = async (values: FormikValues, actions: FormikHelpers<FormikValues>) => {
        console.log("is Last Step: " + isLastStep)
        if (step.props.onSubmit) {
            await step.props.onSubmit(values)
        }

        if (isLastStep) {
            return onSubmit(values, actions);
        } else {
            actions.setTouched({});
            next(values);
        }
    };

    const addParticipant = (values: FormikValues, actions: FormikHelpers<FormikValues>) => {
        actions.setFieldValue("participants", [
            ...values.participants,
            {jss_id: '', npm: '', name: '', cv: '', img: ''}
        ]);
    }


    return (
        <div>
            <Formik
                initialValues={snapshot}
                onSubmit={handleSubmit}
                validationSchema={step.props.validationSchema}>

                {(formik) => (

                    <div className="flex justify-center w-full">
                        <div className="container max-w-screen-xl">
                            <div className="relative w-full -mt-16 bg-white border shadow-lg rounded-xl">
                                <div
                                    className="sticky z-30 flex items-center justify-between px-5 py-4 border-b rounded-t-xl bg-gray-50 top-16 md:top-17">
                                    <span className="text-sm font-semibold text-green-900 md:text-lg">
                                        {step.props.stepName}
                                    </span>
                                    {step.props.stepName === "Informasi Peserta" && (
                                        <button type="button"
                                                onClick={() => addParticipant(formik.values, formik)}
                                                className="block p-1 px-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-md md:py-2 md:px-4">
                                            Tambah Peserta
                                        </button>
                                    )}
                                </div>

                                <div className={step.props.stepName === "Review Formulir" ? 'p-0' : 'p-5'}>
                                    <Form>

                                        {step}

                                        <div className="flex justify-end mt-16">

                                            {/* <button
                                                type="button"
                                                className="block pb-1 text-sm font-semibold text-red-700 hover:text-red-900">
                                                Batalkan Pengajuan
                                            </button> */}

                                            <div
                                                className={step.props.stepName === "Review Formulir" ? 'flex p-5' : 'flex p-0'}>
                                                {stepNumber > 0 && (
                                                    <button
                                                        type="button"
                                                        onClick={() => previous(formik.values)}
                                                        className="block p-1 px-2 mr-2 text-sm font-semibold text-gray-600 border border-gray-300 rounded-md md:px-4 md:py-2">
                                                        Sebelumnya
                                                    </button>
                                                )}

                                                <button
                                                    type="submit"
                                                    className="block p-1 px-2 text-sm font-semibold text-gray-600 border border-gray-300 rounded-md md:px-4 md:py-2">
                                                    {isLastStep ? 'Kirim Pengajuan' : 'Berikutnya'}
                                                </button>
                                            </div>
                                        </div>
                                    </Form>
                                </div>
                                {/* <Debug /> */}
                            </div>
                        </div>
                    </div>

                )}
            </Formik>
        </div>
    );
}

export default FormikWizard;

export const FormStep = ({children}: any) => children;