import {Admin, Agency, Apprentice, Team} from './models';

export type Nullable<T> = T | null;

export type InertiaSharedProps<T = {}> = T & {
    title: string;
    errors: any;
    errorBags: any;
    auth: { user: User };
    total_team: Number;
    total_admin: Number;
    total_project: Number;
    total_submission: Number;
    agencies: Agency[];
    team: Team;
    flash: {
        type: string;
        message: string;
    };
    filters: {
        search: string;
        select: string;
        show: string;
        status: string;
    };
}

export type PaginatedData<T = {}> = Meta & {
    data: T[];
    links: LinkPagination;
}

type User = {
    id: string;
    fullname: string;
    username: string;
    admin: Admin;
    apprentice: Apprentice;
}

export type SelectOptions = {
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
    meta: {
        current_page: number;
        from: number;
        last_page: number;
        links: MetaLink[];
        path: string;
        per_page: number;
        to: number;
        total: number;
    }
}

export type MetaLink = {
    active: boolean;
    label: string;
    url?: string;
}

export type Pagination<T = {}> = {
    current_page: number;
    data: T[];
    first_page_url: number;
    from: number;
    last_page: number;
    last_page_url: string;
    links: MetaLink[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}
