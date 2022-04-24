<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Déposer ma candidature</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        form {
            margin-top: 5rem;
            margin-bottom: 5rem;
        }

        .alert {
            margin-top: 5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                <form method="POST" action="{{ url('/create') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="radio">
                                    <strong>Candidature</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-mail <small class="text-default">*</small></label>
                        <input type="email" class="form-control" id="inputEmail" name="email" value="test@test.com" placeholder="" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputFirstname">Prénom <small class="text-default">*</small></label>
                                <input type="text" class="form-control" id="inputFirstname" value="test" name="firstname" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLastname">Nom <small class="text-default">*</small></label>
                                <input type="text" class="form-control" id="inputLastname" value="test" name="lastname" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStudy">Niveau d'études <small class="text-default">*</small></label>
                        <select class="form-control" id="inputStudy" name="degree" value="5" required>
                            <option value="">Sélectionnez un niveau d'études...</option>
                            @foreach ($degrees as $degree)
                            <option value="{{$degree->id}}">{{$degree->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputRegion">Région <small class="text-default">*</small></label>
                        <select class="form-control" id="inputRegion" name="region" value="5" required>
                            <option value="">Sélectionnez une région...</option>
                            <option value="-1" selected>France entière</option>
                            @foreach ($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputDep">Département <small class="text-default">*</small></label>
                        <select class="form-control" id="inputDep" name="department" value="5" required>
                            <option value="">Sélectionnez un département...</option>
                            <option value="-1" selected>France entière</option>
                            @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputFonction">Domaine d'expérience <small class="text-default">*</small></label>
                        <select class="form-control" id="inputFonction" name="field" value="5" required>
                            <option value="">Sélectionnez un domaine d'expérience...</option>
                            @foreach ($fields as $field)
                            <option value="{{$field->id}}">{{$field->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputJob">Fonction <small class="text-default">*</small></label>
                        <select class="form-control" id="inputJob" name="job" value="5" required>
                            <option value="">Sélectionnez une fonction...</option>
                            @foreach ($jobs as $job)
                            <option value="{{$job->id}}">{{$job->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputSearched">Fonction recherchée <small class="text-default">*</small></label>
                        <select class="form-control" id="inputSearched" value="5" name="target" required>
                            <option value="">Sélectionnez une fonction recherchée...</option>
                            @foreach ($targets as $target)
                            <option value="{{$target->id}}">{{$target->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputRef">Référence annonce</label>
                        <input type="text" class="form-control" id="inputRef" name="ref" placeholder="" value="{{$ref}}">
                    </div>
                    <div class="form-group">
                        <label for="cvFile">Mon CV <small class="text-default">*</small></label>
                        <input type="file" id="cvFile" name="cv" accept=".pdf" required>
                        <p class="help-block">Format accepté : <b>PDF</b>. Taille maximale : <b>5Mo</b>.</p>
                    </div>
                    <div class="form-group">
                        <label for="lettreFile">Ma lettre de motivation</label>
                        <input type="file" id="lettreFile" name="letter" accept=".pdf">
                        <p class="help-block">Format accepté : <b>PDF</b>. Taille maximale : <b>5Mo</b>.</p>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="rgpd" name="rgpd" required>
                        <label for="rgpd">J'accepte les règles de la RGPD<small class="text-default">*</small></label>
                    </div>
                    <p class="help-block text-right"><small class="text-default">*</small> Champ requis</p>
                    <button type="submit" class="btn btn-default">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>

</html>