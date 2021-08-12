import React from 'react'
import { render } from 'react-dom'
import moment from 'moment-timezone';
import { createInertiaApp } from '@inertiajs/inertia-react'
import { InertiaProgress } from '@inertiajs/progress'
import { Ziggy } from './ziggy';

moment.locale('id');
window.Ziggy = Ziggy;

InertiaProgress.init({
    color: '#10B981'
})

createInertiaApp({
    resolve: name => import(`./Pages/${name}`).then((module) => module.default),
    setup({ el, App, props }) {
        render(<App {...props} />, el)
    },
})
