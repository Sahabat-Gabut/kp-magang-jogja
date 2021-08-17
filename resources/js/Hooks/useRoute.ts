import {RouteParamsWithQueryOverload as params, Router} from 'ziggy-js';

export default function useRoute() {
    function routeWrapper(
        name?: undefined,
        params?: params,
        absolute?: boolean,
    ): Router;

    function routeWrapper(
        name: string,
        params?: params,
        absolute?: boolean,
    ): string;

    function routeWrapper(
        name?: any,
        params?: params,
        absolute?: boolean,
    ): any {
        return (window as any).route(name, params, absolute);
    }

    return routeWrapper;
}