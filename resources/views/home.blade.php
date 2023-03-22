<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KLASEMEN SEPAK BOLA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    @if (session('success'))
    <div class="toast-container p-3 top-0 start-50 translate-middle-x position-fixed mt-5">
        <div class="toast bg-success-subtle border-success text-success show" style="opacity:.8" id="toast">
          <div class="toast-body text-center">
            <p class="fs-6 mb-0 opacity-100">{{ session('success') }}</p>
          </div>
        </div>
    </div>
    @endif


    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <a href="{{ route('home') }}" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="{{ asset('img/liga1.png') }}" alt="Liga 1" width="50">
                    <span class="fs-4 ms-2">BRI Liga 1</span>
                </a>
            </header>
      
            <div class="px-2 px-md-5 py-3 mb-4 bg-white rounded-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="fs-1 fw-bold text-center">Klasemen Liga Indonesia</h1>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-data-club" type="button">Tambah Data Klub</button>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update-standings" type="button">Update Klasemen</button>
                        </div>
                        <div class="col-md-4 d-flex justify-content-start justify-content-md-end mt-3 mt-md-0">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reset-standings" type="button">Reset Klasemen</button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-striped border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">No</th>
                                            <th>Klub</th>
                                            <th width="8%" class="text-center">Ma</th>
                                            <th width="8%" class="text-center">Me</th>
                                            <th width="8%" class="text-center">S</th>
                                            <th width="8%" class="text-center">K</th>
                                            <th width="8%" class="text-center">GM</th>
                                            <th width="8%" class="text-center">GK</th>
                                            <th width="8%" class="text-center">Point</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td class="text-center">1</td>
                                            <td>Persib</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>4</td>
                                            <td>0</td>
                                            <td>6</td>
                                        </tr> --}}
                                        @foreach ($clubs as $club)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $club->name }}</td>
                                                <td class="text-center">{{ $club->matches }}</td>
                                                <td class="text-center">{{ $club->wins }}</td>
                                                <td class="text-center">{{ $club->draws }}</td>
                                                <td class="text-center">{{ $club->loses }}</td>
                                                <td class="text-center">{{ $club->goals_win }}</td>
                                                <td class="text-center">{{ $club->goals_lose }}</td>
                                                <td class="text-center">{{ $club->points }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <p class="text-muted m-0">Ma = Main</p>
                            <p class="text-muted m-0">Me = Menang</p>
                            <p class="text-muted m-0">S = Seri</p>
                            <p class="text-muted m-0">K = Kalah</p>
                            <p class="text-muted m-0">GM = Gol Menang</p>
                            <p class="text-muted m-0">GK = Gol Kalah</p>
                        </div>
                    </div>
                </div>
            </div>
      
            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; {{ date('Y') }}
            </footer>
        </div>
    </main>

<!-- Modal -->
<div class="modal fade" id="add-data-club" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="{{ route('add.club') }}">
            @csrf
            @method('POST')
            <div class="modal-header">
            <h1 class="modal-title fs-5">Tambah Data Klub</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Klub</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Nama Kota</label>
                    <input type="text" class="form-control" id="city" name="city" autocomplete="off" required>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="reset-standings" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="{{ route('reset.standings') }}">
            @csrf
            @method('POST')
            <div class="modal-header">
            <h1 class="modal-title fs-5">Reset Data Klasemen</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="m-0">Apakah anda yakin ingin mereset data klasemen ?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-danger px-4">Reset</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="update-standings" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="POST" action="{{ route('update.standings') }}">
            @csrf
            @method('POST')
            <div class="modal-header">
            <h1 class="modal-title fs-5">Update Klasemen</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="matches">
                    <div class="row club-match">
                        <div class="col-10">
                            <label class="form-label match-label">Pertandingan 1</label>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            <button type="button" class="btn-close remove-match" disabled></button>
                        </div>
    
                        <div class="col-5">
                            <select class="form-select club" name="club1[]" required>
                                <option disabled selected value="">Pilih Klub</option>
                                @foreach ($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center">
                           <p class="fs-5 fw-bold">⎯</p>
                        </div>
                        <div class="col-5">
                            <select class="form-select club" name="club2[]" required>
                                <option disabled selected value="">Pilih Klub</option>
                                @foreach ($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-5">
                            <input type="text" class="form-control score" name="score1[]" placeholder="Skor" autocomplete="off" required>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center">
                           <p class="fs-5 fw-bold">⎯</p>
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control score" name="score2[]" placeholder="Skor" autocomplete="off" required>
                        </div>
                    </div>
                </div>

                <a href="#" class="text-decoration-none" id="add-match">Tambah Pertandingan</a>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
            </div>
        </form>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            //remove toast after 3 seconds
            setTimeout(function() {
                $('.toast').animate({opacity: 0}, 500, function() {
                    $(this).remove();
                })
            }, 3000);

            //validating input score
            $('#update-standings').on('input', '.score', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
            

            //add new input match and score when button add match clicked
            $('#add-match').click(function(e) {
                e.preventDefault();

                let match = $('#update-standings .modal-body .matches .club-match').length + 1;

                $('#update-standings .modal-body .matches .club-match .remove-match').removeAttr('disabled');

                $('#update-standings .modal-body #add-match').before(`
                    <div class="matches">
                        <div class="row club-match">
                            <div class="col-10">
                                <label class="form-label match-label">Pertandingan ${match}</label>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <button type="button" class="btn-close remove-match"></button>
                            </div>
                            <div class="col-5">
                                <select class="form-select club" name="club1[]" required>
                                    <option disabled selected value="">Pilih Klub</option>
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center">
                            <p class="fs-5 fw-bold">⎯</p>
                            </div>
                            <div class="col-5">
                                <select class="form-select club" name="club2[]" required>
                                    <option disabled selected value="">Pilih Klub</option>
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <input type="text" class="form-control score" name="score1[]" placeholder="Skor" autocomplete="off" required>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center">
                            <p class="fs-5 fw-bold">⎯</p>
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control score" name="score2[]" placeholder="Skor" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                `);

                //auto scroll to bottom
                $('#update-standings .modal-body').animate({scrollTop: $('#update-standings .modal-body').prop("scrollHeight")}, 1);
            });

            // remove match
            $('#update-standings').on('click', '.remove-match', function() {
                $(this).parent().parent().next().remove();
                $(this).parent().parent().next().remove();
                $(this).parent().parent().remove();

                let match = $('#update-standings .modal-body .matches .club-match').length;

                if (match == 1) {
                    $('#update-standings .modal-body .matches .club-match .remove-match').attr('disabled', 'disabled');
                }

                //change .match-label
                $('#update-standings .modal-body .matches .club-match .match-label').each(function(index) {
                    $(this).text(`Pertandingan ${index + 1}`);
                });

                var selectedOptions = [];
                $('.club').each(function () {
                    selectedOptions.push($(this).find(":selected").val());
                });
                
                //disable all options that have value in selectedOptions array
                $('.club').each(function () {
                    $(this).find('option').each(function () {
                        if (selectedOptions.includes($(this).val())) {
                            if ($(this).parent().find(":selected").val() != $(this).val()) {
                                $(this).prop('disabled', true);
                            }
                        } else {
                            $(this).prop('disabled', false);
                        }
                    });
                });
            });
            

            //updating option on select when select is changed
            $('#update-standings').on('change', '.club', function () {
                // var selectedOption = $(this).find(":selected").val();
                var selectedOptions = [];
                
                $('.club').each(function () {
                    selectedOptions.push($(this).find(":selected").val());
                });
                
                $('.club').each(function () {
                    $(this).find('option').each(function () {
                        if (selectedOptions.includes($(this).val())) {
                            //disabled for all except the selected option
                            if ($(this).parent().find(":selected").val() != $(this).val()) {
                                $(this).prop('disabled', true);
                            }
                        } else {
                            $(this).prop('disabled', false);
                        }
                    });
                });
            });

            //updating option on select when add match button is clicked
            $('#update-standings').on('click', '#add-match', function () {
                var selectedOptions = [];

                //save the value of the selected option in each <select> element to the array
                $('.club').each(function () {
                    selectedOptions.push($(this).find(":selected").val());
                });
                
                //disable all options that have value in selectedOptions array
                $('.club').each(function () {
                    $(this).find('option').each(function () {
                        if (selectedOptions.includes($(this).val())) {
                            if ($(this).parent().find(":selected").val() != $(this).val()) {
                                $(this).prop('disabled', true);
                            }
                        } else {
                            $(this).prop('disabled', false);
                        }
                    });
                });
            });

        });
    </script>
</body>
</html>