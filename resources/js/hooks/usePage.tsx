import { UsePageProps } from "@/types/UsePageProps";
import { usePage as Page } from "@inertiajs/inertia-react";

export function usePage():UsePageProps {
    return Page();
}
