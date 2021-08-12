import { Page, PageProps } from '@inertiajs/inertia';
import { Admin, Agency, Apprentice, Attendance, JSS, Project, Role, Team } from './models';

export interface UsePageProps extends Page<PageProps> {
    props: {
        title: string;
        auth: Auth;
        admins: Admin[]
        agencies: Agency[];
        agency_paginate: {
            data: Agency[];
            links: LinkPagination;
            meta: Meta;
        };
        admin_paginate: {
            data: Admin[];
            links: LinkPagination;
            meta: Meta;
        };
        submission_paginate: {
            data: Team[];
            links: LinkPagination;
            meta: Meta;
        },
        attendance_paginate: {
            data: Attendance[];
            links: LinkPagination;
            meta: Meta;
        },
        team_paginate: {
            data: Team[];
            links: LinkPagination;
            meta: Meta;
        },
        project_paginate: {
            data: Project[];
            links: LinkPagination;
            meta: Meta;
        },
        filters: {
            search: string;
            select: string;
            show: string;
            status: string;
        },
        flash: {
            type: string;
            message: string;
        }
        roles: Role[];
        percentage: number;
        team: Team;
        project: Project;
        apprentices: {
            data: Apprentice[]
        };
        total_team: Number;
        total_submission: Number;
        total_project: Number;
        total_admin: Number;
        errors: any;
        errorBags: any[];
        options: SelectOptions[];
        submissions: Team[];
    }
}

type Auth = {
    user?: {
        id: string;
        fullname: string;
        username: string;
        admin: Admin;
        apprentice: Apprentice;
    }
}

type SelectOptions = {
    label: string;
    value: string;
}

// PAGINATION
export type LinkPagination = {
    first: string;
    last: string;
    next: string;
    prev: string;
}

export type Meta = {
    current_page?: number;
    from?: number;
    last_page?: number;
    links?: MetaLink[];
    path?: string;
    per_page?: number;
    to?: number;
    total?: number;
}

export type MetaLink = {
    active?: boolean;
    label?: string;
    url?: string;
}