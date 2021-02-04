<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        body {
          margin-top: 180px;
        }
    </style>
    <title>Hello, Admin!</title>
  </head>
  <body>

    <h3 class="text-center mb-5">Admin Antrian Kecantikan</h3>

    <div class="row">
      <div class="col-md-6 offset-md-3">
          <div class="card">
              <div class="card-body">
                <div class="card-title d-flex justify-content-between">
                  <h5>Dashboard</h5>
                  {{-- <a href="" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"> --}}
                  <a href="{{ url('/admin/reset') }}" class="btn btn-dark" onclick="return confirm('kamu yakin ingin menghapus data antrian hari ini ?')">
                      Reset Antrian
                  </a>
                </div>
                <table class="table mt-2">
                    <thead class="table-dark">
                      <tr>
                        <td>Nama</td>
                        <td>Nomor Antrian</td>
                        <td>Status</td>
                        <td>#</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $item)
                          <tr>
                            <td>{{$item['users']['name']}}</td>
                            <td>{{$item['nomor_antrian']}}</td>
                            <td>{{$item['status']}}</td>
                            <td>
                              @if($item['status'] == "Dilayani")
                                <a href="{{ url('/admin/update/' . $item['id']) }}" class="btn btn-sm btn-dark">Selesai</a>
                              @endif
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
      </div>
    </div>

    <!-- Vertically centered modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Reset Antrian</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>