import React, { DragEvent, useState } from 'react';
// ARCHIVED
const DropZone = () => {

    const [file, setFile] = useState<File>();
    const [errorMessage, setErrorMessage] = useState('');

    const _onDragOver = (event: DragEvent<HTMLDivElement>) => {
        event.preventDefault();
    }

    const _onDragEnter = (event: DragEvent<HTMLDivElement>) => {
        event.preventDefault();
    }

    const _onDragLeave = (event: DragEvent<HTMLDivElement>) => {
        event.preventDefault();
    }

    const _onDrop = (event: DragEvent<HTMLDivElement>) => {
        event.preventDefault();
        const files = event.dataTransfer.files;
        if (files.length) {
            handleFiles(files);
        }
    }

    const handleFiles = (files: FileList) => {
        for (let i = 0; i < files.length; i++) {
            if (validateFile(files[i])) {

            } else {
                // add a new property called invalid
                // @ts-ignore
                files[i]['invalid'] = true;
                // add to the same array so we can display the name of the file

                setFile(files[i]);
                // set error message
                setErrorMessage('File type not permitted');
            }
        }
    }

    const validateFile = (file: File) => {
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/x-icon'];
        if (validTypes.indexOf(file.type) === -1) {
            return false;
        }
        return true;
    }

    const fileSize = (size: number) => {
        if (size === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(size) / Math.log(k));
        return parseFloat((size / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    const fileType = (fileName: string) => {
        return fileName.substring(fileName.lastIndexOf('.') + 1, fileName.length) || fileName;
    }

    return (
        <div className="">
            <div onDragOver={_onDragOver}
                onDragEnter={_onDragEnter}
                onDragLeave={_onDragLeave}
                onDrop={_onDrop}
                className="flex items-center justify-center w-full h-20 m-0 border border-gray-300 border-dashed rounded-md cursor-pointer">
                <div className="flex select-none">
                    {/* TODOS: CREATE ELEMENT ICONS! */}
                    {/* <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg> */}
                    {/* <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fillRule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clipRule="evenodd"></path></svg> */}

                    <svg className="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>

                    <span>
                        Drag & Drop files here or click to upload
                    </span>
                </div>
            </div>
            <div className="relative w-full h-full">
                <div>
                    <div className="absolute bg-no-repeat h-30 w-30"></div>
                    <div className="absolute inline-block text-sm font-semibold uppercase file-type">png</div>
                    <span className="inline-block ml-20 align-top file-name">test-file.png</span>
           
                    <span className="inline-block mx-4 align-top file-size">({
                    // @ts-ignore
                    fileSize(file.size)})</span>
                </div>
            </div>
        </div>
    )
}
export default DropZone;