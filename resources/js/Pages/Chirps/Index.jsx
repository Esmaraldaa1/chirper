import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Chirp from '@/Components/Chirp'; // to accept the chirps prop and render a Chirp component for each chirp
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm, Head } from '@inertiajs/inertia-react';

export default function Index({ auth, chirps }) { // to accept the chirps prop and render a Chirp component for each chirp
    const {data, setData, post, processing, reset, errors} = useForm({ // useForm is a hook that allows me to easily manage form state and submit data to the server. (Hooks are a new feature in React that allow us to easily share logic between components.)
        message: '',
    });

    const submit = (e) => { // to submit the form. e is the event object, which I use to prevent the default browser behavior of submitting the form.
        e.preventDefault();
        post(route('chirps.store'), {onSuccess: () => reset()});
    };

    // The AuthenticatedLayout component is a layout component that wraps the page content in a common layout.
    // In this case, the AuthenticatedLayout component renders the page header and navigation.
    return (
        <AuthenticatedLayout auth={auth}>
            <Head title="Chirps"/>

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <textarea
                        value={data.message}
                        placeholder="What's on your mind?"
                        className="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        onChange={e => setData('message', e.target.value)}
                    ></textarea>
                    <InputError message={errors.message} className="mt-2"/>
                    <PrimaryButton className="mt-4" processing={processing}>Chirp</PrimaryButton>
                </form>

                <div className="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    {chirps.map(chirp =>
                        <Chirp key={chirp.id} chirp={chirp} />
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
