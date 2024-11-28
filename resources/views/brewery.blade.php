@extends('layouts.app')

@section('content')
<div class="container">

    <div id="brewery-data"></div>

    <script>
        $(document).ready(function() {

            const token = localStorage.getItem('api_token');
            // const token = '123456'

            $.ajax({
                url: '/api/breweries/{{ $id }}',
                method : 'get',
                // type : 'json',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                success : function(data) {

                    console.log(data)
                    
                    for (const key in data) {
                        if (data.hasOwnProperty(key)) {
                            const value = data[key] || 'N/A'; // Gestione valori nulli
                            $('#brewery-data').append(`<tr><td><strong>${(key)}:</strong></td><td>${value}</td></tr>`);
                        }
                    }

                }
            })

        })

    </script>


</div>
@endsection