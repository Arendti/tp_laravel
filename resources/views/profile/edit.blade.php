@extends('layout.main')

@section('content')

<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Profile</h2>
        </div>
        <div class="projects-grid">
            <div class="project-card">
                <div class="project-stats">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="project-stats">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="project-stats">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection