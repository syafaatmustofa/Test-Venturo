<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        td,
        th {
            font-size: 11px;
        }

    </style>


    <title>TES - Venturo Camp Tahap 2</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="my-select" class="form-control" name="tahun">
                                    <option value="" selected>Pilih Tahun</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                @isset($menu)
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                <th colspan="12" style="text-align: center;" > Periode Pada {{ $tahun }}
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                            </tr>
                            <tr class="table-dark">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                            </tr>
                            {{-- perulangan dengan kategori makanan --}}
                            @foreach($menu as $item2)
                            <tr>
                                @if($item2->kategori == 'makanan')
                                <td>{{ $item2->menu }}</td>
                                @for($i = 1; $i <= 12; $i++) <td>{{($result[$item2->menu][$i] !=0)? $result[$item2->menu][$i] : '' }}</td>
                                    @endfor
                                    <td class="fw-bold">
                                        {{ number_format($jumlahmenu[$item2->menu], 0, ',', '.') }}
                                    </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                            </tr>
                            {{-- perulangan dengan kategori minuman --}}
                            @foreach($menu as $item)
                            <tr>
                                @if($item->kategori == 'minuman')
                                <td>{{ $item->menu }}</td>
                                @for($i = 1; $i <= 12; $i++) <td>{{ ($result[$item->menu][$i] !=0)? $result[$item->menu][$i] : '' }}</td>
                                    @endfor
                                    <td class="fw-bold">
                                        {{ number_format($jumlahmenu[$item->menu], 0, ',', '.') }}
                                    </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                {{-- total --}}
                                <td class="fw-bold">Total</td>
                                @for ($i = 1; $i <= 12; $i++) <td class="fw-bold">{{ number_format($jumlah[$i], 0, ',', '.') }}</td>
                                    @endfor
                                    <td class="fw-bold">{{ number_format($nilai, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @endisset
        </div>
    </div>
    <footer>
        <div class="text-center">
            <h5>Syafaat Mustofah || Test Venturo</h5>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>
