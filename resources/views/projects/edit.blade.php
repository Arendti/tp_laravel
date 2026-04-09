@extends('layout.main')

@section('content')

<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Edit Project</h2>
        </div>

        <form class="form-container" id="new-project-form" action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-section">
                <h3>Project Information</h3>
                
                <div class="form-group">
                    <label for="project-name">Project Name <span class="required">*</span></label>
                    <input type="text" id="project-name" name="Project_Name" value="{{$project->project_title}}">
                    <div class="error-text titanic" id="project-name-error">Project name is required.</div>
                </div>

                <div class="form-group">
                    <label for="project-description">Description <span class="required">*</span></label>
                    <textarea id="project-description" name="Project_Description" rows="5">{{$project->project_description}}</textarea>
                    <div class="error-text titanic" id="project-description-error">Project description is required.</div>
                </div>
            </div>

            <div class="form-section">
                <h3>Contract Details</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="project-included-hours">Included Hours <span class="required">*</span></label>
                        <input type="number" id="project-included-hours" name="Included_Hours" value="{{$project->included_hours}}" min="0">
                        <div class="error-text titanic" id="project-included-hours-error">Included hours are required.</div>
                    </div>

                    <div class="form-group">
                        <label for="project-hourly-rate">Hourly Rate (€) <span class="required">*</span></label>
                        <input type="number" id="project-hourly-rate" name="Hourly_Rate" value="{{$project->hourly_rate}}" min="0" step="0.01">
                        <div class="error-text titanic" id="project-hourly-rate-error">Hourly rate is required.</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="project-start-date">Validity Start Date <span class="required">*</span></label>
                        <input type="date" id="project-start-date" name="Start_Date" value="{{$project->start_date}}">
                        <div class="error-text titanic" id="project-start-date-error">Start date is required.</div>
                    </div>

                    <div class="form-group">
                        <label for="project-end-date">Validity End Date <span class="required">*</span></label>
                        <input type="date" id="project-end-date" name="End_Date" value="{{$project->end_date}}">
                        <div class="error-text titanic" id="project-end-date-error">End date is required.</div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Team Assignment</h3>

                <div class="form-group">
                    <label for="project-manager">Project developpers<span class="required">*</span></label>
                    <select id="project-manager" name="Dev_ID">
                        <option value="">Select project manager</option>
                        @foreach ($devs as $dev)
                            <option value="{{$dev->id}}">{{$dev->name}}</option>
                        @endforeach
                    </select>
                    <div class="error-text titanic" id="project-manager-error">Project developpers selection is required.</div>
                </div>

                <div class="form-group">
                    <label for="project-client">Client<span class="required">*</span></label>
                    <select id="project-client" name="Client_ID" value={{ $project->client}}>
                        <option value="">Select client</option>
                        @foreach ($clients as $client):
                            <option value="{{$client->id}}" @if($client->id == $project->client->id): selected @endif>{{$client->name}}</option>
                        @endforeach
                    </select>
                    <div class="error-text titanic" id="project-client-error">Client name is required.</div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Edit Project</button>
                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
</main>

@endsection