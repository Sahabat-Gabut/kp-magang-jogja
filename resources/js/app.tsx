import React from 'react'
import {render} from 'react-dom'
import moment from 'moment-timezone';
import {createInertiaApp} from '@inertiajs/inertia-react'
import {InertiaProgress} from '@inertiajs/progress'

moment.locale('id');
InertiaProgress.init({color: '#10B981'});

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Magang Jogja';

createInertiaApp({
    title: title => title === 'Magang Jogja' ? title : `${title} - ${appName}`,
    // @ts-ignore
    resolve: name => import(`./Pages/${name}`).then((module) => module.default),
    setup({el, App, props}) {
        render(<App {...props} />, el)
    },
});
