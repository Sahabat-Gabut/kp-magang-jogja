import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import { Meta, MetaLink } from '@/types/UsePageProps';

const PageLink = ({ url = '', label = '', active = false }: MetaLink) => {
  return (
    <InertiaLink
      href={url}
      className={`w-10 h-10 transition duration-200 rounded-lg flex items-center justify-center bg-gray-100 hover:bg-gray-200 ${active ? 'bg-green-300 text-green-800 hover:bg-green-400' : ''}`}
      dangerouslySetInnerHTML={{ __html: label }}>
    </InertiaLink>
  );
};

const PageInactive = ({ label = '' }: MetaLink) => {
  return (
    <div dangerouslySetInnerHTML={{ __html: label }}
      className="px-4 py-2 mb-1 mr-1 text-sm bg-gray-100 border border-gray-300 border-solid rounded cursor-not-allowed text-gray" />
  );
};


export default ({ links = [], from = 0, to = 0, total = 0 }: Meta) => {
  if (links.length === 3) return null;
  return (
    <div className="flex flex-wrap items-center justify-between w-full mt-6 -mb-1 select-none">
      <ul className="flex items-center gap-x-1">
        {links.map((link) => {
          return link.url !== null && (
            <li key={link.label}>
              <PageLink label={link.label} active={link.active} url={link.url} />
            </li>
          )
        })}
      </ul>

      <div className="text-sm text-gray-800">
        <span>{from} - {to} dari {total}</span>
      </div>
    </div>
  );
};