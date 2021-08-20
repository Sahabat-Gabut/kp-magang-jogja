export type JSS = {
    id: string
    fullname: string
    email: string
    no_wa: string
    username: string
}

export type Admin = {
    id: number
    agency_id: number
    photo: string
    role: Role
    jss: JSS
}

export type Team = {
    id: number
    agency_id: number
    status: string
    university: string
    department: string
    proposal: string
    presentation: string
    cover_letter: string
    date_start: Date
    date_finish: Date
    date_of_created: Date
    agency: Agency
    apprentices: Apprentice[]
    jss: JSS;
    project: Project;
    admin: Admin;
    validation: Validation;
}

export type Project = {
    id: number;
    admin_id: number;
    team_id: number;
    name: string;
    description: string;
    status: string;
    team: Team;
    admin: Admin;
    progress: ProgressProject[];
}

export type ProgressProject = {
    id: number;
    project_id: number;
    apprentice_id: number;
    name: string;
    description: string;
    status: string;
    link: string;
    date_of_created: Date;
    jss: JSS;
    valuation: any;
}

export type Apprentice = {
    id: number;
    jss_id: string;
    team_id: number;
    npm: string;
    cv: string;
    photo: string;
    team: Team;
    jss: JSS;
}

export type Agency = {
    id: number
    name: string
    location?: string
    quota: number
}

export type Role = {
    id: number
    name: string
}

export type Attendance = {
    id: number
    apprentice_id: number
    start_attendance: Date
    end_attendance: Date
    status: string
    apprentice?: Apprentice
}

export type Validation = {
    id: number;
    admin_id: number;
    result_date: Date;
    response_letter: string;
}
