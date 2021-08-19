import React from 'react'
import {render} from 'react-dom'
import moment from 'moment-timezone';
import {createInertiaApp} from '@inertiajs/inertia-react'
import {InertiaProgress} from '@inertiajs/progress'
import {appName} from "@/Common/constants";

moment.locale('id');
InertiaProgress.init({color: '#10B981'});

createInertiaApp({
    title: title => title === 'Magang Jogja' ? title : `${title} - ${appName}`,
    // @ts-ignore
    resolve: name => import(`./Pages/${name}`).then((module) => module.default),
    setup({el, App, props}) {
        render(<App {...props} />, el)
    },
});
