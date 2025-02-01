@props([
    'headers' => [],
    'id' => 'dataTable',
    'ajax' => '',
    'columns' => [],
    'searchable' => true,
    'sortable' => true,
    'pagination' => true,
    'responsive' => true,
    'striped' => true,
    'bordered' => true,
    'hover' => true,
    'class' => '',
    'createRoute' => null,
    'order' => [[0, 'desc']],
])

<div class="table-responsive">
    <table id="{{ $id }}"
        class="table {{ $striped ? 'table-striped' : '' }}
        {{ $bordered ? 'table-bordered' : '' }}
        {{ $hover ? 'table-hover' : '' }}
        text-center
        {{ $class }}
        ">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th class="text-center">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
    </table>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.5.0/css/searchBuilder.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.0/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <style>
        /* Modern table styling */
        #{{ $id }} {
            --bs-table-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.02);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.04);
            border-radius: 8px;
            overflow: hidden;
        }

        #{{ $id }} thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #e9ecef;
            padding: 1rem;
        }

        #{{ $id }} tbody td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }

        /* Modern button styling */
        .dt-buttons .btn {
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .dt-buttons .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Modern pagination styling */
        .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            margin: 0 2px !important;
            transition: all 0.2s ease !important;
        }

        .dataTables_paginate .paginate_button:hover {
            background: #f8f9fa !important;
            color: #0d6efd !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Modern search input styling */
        .dataTables_filter input {
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            border: 1px solid #dee2e6;
            transition: all 0.2s ease;
        }

        .dataTables_filter input:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* Modern processing indicator */
        .dataTables_processing {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(2px);
            border-radius: 8px;
            padding: 1.5rem !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#{{ $id }}').DataTable({
                processing: true,
                serverSide: true,
                responsive: @json($responsive),
                searching: @json($searchable),
                ordering: @json($sortable),
                paging: @json($pagination),
                ajax: @json($ajax),
                columns: @json($columns),
                order: @json($order),
                select: {
                    style: 'multi',
                    selector: 'td.select-checkbox'
                },
                dom: '<"d-flex justify-content-between align-items-center mb-4"<"d-flex gap-3"B><"d-flex gap-3"f>>rt<"d-flex justify-content-between align-items-center mt-4"<"d-flex gap-3"li>p>',
                buttons: [
                    @if ($createRoute)
                        {
                            text: '<i class="fas fa-plus"></i> New',
                            className: 'btn btn-primary',
                            action: function() {
                                window.location.href = '{{ $createRoute }}';
                            }
                        },
                    @endif {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-info',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });
    </script>
@endpush
