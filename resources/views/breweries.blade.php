@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Birrerie</h1>
    <table id="breweries-table" class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Città</th>
                <th>Stato</th>
                <th>id</th>
            </tr>
        </thead>
    </table>


    <script>
        $(document).ready(function() {

            const token = localStorage.getItem('api_token');
            /* 
            $.ajax({
                url: '/api/breweries',
                method : 'get',
                // type : 'json',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                success : function(data) {

                }
            })
            */

            $('#breweries-table').DataTable({
                processing: true,
                serverSide: false, // Poiché stai gestendo i dati manualmente
                ajax: function(data, callback, settings) {
                    $.ajax({
                        url: '/api/breweries',
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${token}`
                        },
                        success: function(response) {
                            // Passa i dati ricevuti alla DataTable
                            callback({ data: response });
                        },
                        error: function(xhr, status, error) {
                            console.error("Errore nella chiamata API:", error);
                            callback({ data: [] }); // Evita il crash della tabella
                        }
                    });
                },
                columns: [
                    { data: 'name', title: 'Name' },
                    { data: 'brewery_type', title: 'Type' },
                    { data: 'city', title: 'City' },
                    { data: 'state', title: 'State' },
                    { 
                        data: 'id',
                        title: 'View',
                        render: function(data, type, row) {
                            // Crea il link per accedere ai dettagli
                            return `<a href="/brewery/${data}" class="btn btn-sm btn-primary">View Details</a>`;
                        },
                        orderable: false, // Opzionale: disabilita l'ordinamento per questa colonna
                        searchable: false
                    },
                ]
            });
        })

    </script>

</div>
@endsection