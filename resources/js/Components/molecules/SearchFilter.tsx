import route from 'ziggy-js';
import pickBy from 'lodash/pickBy';
import { usePrevious } from 'react-use';
import { usePage } from '@/hooks/usePage';
import { Inertia } from '@inertiajs/inertia';
import React, { useState, useEffect } from 'react';

export default () => {
  const { filters } = usePage().props;
  const [opened, setOpened] = useState(false);

  const [values, setValues] = useState({
    search: filters.search || ''
  });

  const prevValues = usePrevious(values);

  function reset() {
    setValues({search: ''});
  }

  useEffect(() => {
    if (prevValues) {
      const query = Object.keys(
      pickBy(values)).length
        ? pickBy(values)
        : {};
      Inertia.get(route(route().current()), query, {
        replace: true,
        preserveState: true
      });
    }
  }, [values]);

  function handleChange(e:any) {
    const key = e.target.name;
    const value = e.target.value;

    setValues(values => ({
      ...values, [key]: value
    }));

    if (opened) setOpened(false);
  }

  return (
    <div className="flex items-center w-full">
      <div className="relative flex w-full bg-white rounded">
        <div className="absolute top-0 p-3">
            {/* TODOS: ICON SEARCH! */}
            <svg className="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <input
          className="block w-full py-2 pl-10 pr-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 sm:text-sm"
          autoComplete="off"
          type="text"
          name="search"
          value={values.search}
          onChange={handleChange}
          placeholder="cari..."
        />
        <div className="absolute top-0 p-3 right-2">
            {/* TODOS: ICON SEARCH! */}
            {values.search !== "" ? (
                <svg onClick={reset} className="w-4 h-4 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            ) : ""}
            </div>
      </div>
    </div>
  );
};