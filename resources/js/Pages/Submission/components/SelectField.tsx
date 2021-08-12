import {FieldConfig, useField} from "formik";
import React from "react";
import Select, {OptionsType} from "react-select";

interface Option {
    label: string;
    value: string;
}

interface FormikSelectProps extends FieldConfig {
    options: OptionsType<Option>;
    isMulti?: boolean;
    placeholder?: string;
    label?: string
}

export const SelectField = ({options, label, placeholder = "Pilih...", isMulti = false,...props}: FormikSelectProps) => {
    
    const [field, meta, helpers] = useField<string>(props);
    const getValue = () => {
        if (options) {
            return isMulti
                ? options.filter(option => field.value.indexOf(option.value) >= 0)
                : options.find(option => option.value === field.value);
        } else {
            return isMulti ? [] : ("" as any);
        }
    };
        
    return (
        <>
        <label htmlFor={field.name} className="block pb-1 mt-2 text-sm font-semibold text-gray-600">{label}</label>
        <Select
            {...field}
            {...props}
            name={field.name}
            value={getValue()}
            onChange={(option: Option): void => helpers.setValue(option.value)}
            options={options}
            isMulti={isMulti}
            placeholder={placeholder}
            styles={{
                control: (styles:any, state:any) => ({
                  ...styles,
                  borderColor: state.isFocused ? "#D0EAE2" : meta.touched && meta.error ? '#EF4444' : '#CED4DA',
                  "&:hover": {
                    borderColor: state.isFocused ? "#D0EAE2" : meta.touched && meta.error ? '#EF4444' : '#CED4DA',
                  }
                })
            }}
            theme={theme => ({
                ...theme,
                borderRadius: 6,
                colors: {
                  ...theme.colors,
                  primary25: '#6EE7B7',
                  primary: '#10B981',
                }
            })}
        />
            <span className="block pb-1 text-sm text-red-600">{meta.touched && meta.error}</span>
        </>
    );
};
