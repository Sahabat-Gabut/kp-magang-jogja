import React from 'react'
import { useField } from "formik";
import { at } from "lodash";

const InputField = (props:any) => {
    const { errorText, ...rest } = props;
    const [field, meta] = useField(props);
  
    function _renderHelperText() {
      const [touched, error] = at(meta, 'touched', 'error');
      if (touched && error) {
        return error;
      }
    }

    return(
        <>
            <label className="font-semibold text-sm text-gray-600 pb-1 block mt-2">
                {props.label}
            </label>
            <input name={props.name} type="text" className="border rounded-lg px-3 py-2 mt-1 text-sm w-full border border-gray-300 focus:outline-none focus:border-green-600" />
        </>
    )
}