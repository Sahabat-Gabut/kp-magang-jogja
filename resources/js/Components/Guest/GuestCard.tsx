import {InertiaLink} from '@inertiajs/inertia-react'
import React from 'react'

interface IMainCard {
    img: string
    title: string
    desc: string
    buttonText: string
    buttonLink: string
}

export default function GuestCard(props: IMainCard) {
    return (
        <div className="border border-gray-300 rounded-md" style={{maxWidth: '395px'}}>
            <img className="w-full" src={props.img}/>
            <div className="p-4">
                <h3 className="uppercase">{props.title}</h3>
                <p>{props.desc}</p>
            </div>
            <div className="bg-gray-300 p-3 w-full flex">
                <InertiaLink href={props.buttonLink}
                             className="uppercase font-semibold rounded-sm w-full bg-emerald-700 text-white leading-7 text-center inline-block hover:bg-emerald-600 py-2">{props.buttonText}</InertiaLink>
            </div>
        </div>
    );
}
