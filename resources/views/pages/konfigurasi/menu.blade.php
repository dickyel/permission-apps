<x-master-layout>

    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">        
            <div class="card">
                
                <div class="card-header">
                    <h4>Menu</h4>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @can('create konfigurasi/menu')
                            <a class="btn btn-primary mb-4 add" href="{{ route('konfigurasi.menu.create') }}">
                                Tambah 
                            </a>

                            @endcan

                         
                        </div>
                    </div>
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}


        <script>

            function handleFormSubmit(selector) {
                function init() {
                    $(selector).on('submit', function(e) {
                        e.preventDefault();

                        const _form = this;

                        // Perform client-side validation
                        if (!_form.checkValidity()) {
                            _form.reportValidity();
                            return;
                        }

                        // Proceed with AJAX request if the form is valid
                        $.ajax({
                            url: _form.action,
                            method: _form.method,
                            data: new FormData(_form),
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                // Hapus pesan kesalahan sebelum mengirimkan permintaan
                                $('.is-invalid').removeClass('is-invalid');
                                $('.invalid-feedback').remove();
                                submitLoader().show();
                            },

                            success: (res) => {
                                if (this.runDefaultSuccessCallback) {
                                    $('#modal_action').modal('hide');
                                }
                                this.onSuccessCallback && this.onSuccessCallback(res);
                                this.dataTableId && window.LaravelDataTables[this.dataTableId].ajax.reload();
                            },
                            complete: function() {
                                submitLoader().hide();
                            },
                            error: function(err) {
                                const errors = err.responseJSON?.errors;

                                if (errors) {
                                    for (let [key, message] of Object.entries(errors)) {
                                        console.log(message);
                                        $(`[name=${key}]`).addClass('is-invalid').parent().append(
                                            `<div class="invalid-feedback">
                                                ${message}
                                            </div>`
                                        );
                                    }
                                }
                            }

                        });
                    });
                }

                function onSuccess(cb, runDefault = true) {
                    this.onSuccessCallback = cb;
                    this.runDefaultSuccessCallback = runDefault;
                    return this;
                }

                function setDataTable(id) {
                    this.dataTableId = id;
                    return this;
                }

                return {
                    init,
                    runDefaultSuccessCallback: true,
                    onSuccess,
                    setDataTable
                };
            }

            function handleAjax(url, method = 'get') {
                function onSuccess(cb, runDefault = true) {
                    this.onSuccessCallback = cb
                    this.runDefaultSuccessCallback = runDefault
                    return this
                }

                function execute() {
                  
                    $.ajax({
                        url,
                        method,
                        beforeSend: function() {
                            showLoading()
                        },
                        complete: function() {
                            showLoading(false)
                        },
                        success: (res) => { // Corrected syntax

                            if(this.runDefaultSuccessCallback)
                            {
                                const modal = $('#modal_action')
                                modal.html(res)
                                modal.modal('show')

                            }
                           
                            this.onSuccessCallback && this.onSuccessCallback(res)
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    })
                }

                function onError(cb) {
                    this.onErrorCallback = cb
                    return this
                }

                return {
                    execute,
                    onSuccess,
                    runDefaultSuccessCallback: true
                }
            }


            $('.add').on('click', function(e) {
                e.preventDefault();

                handleAjax(this.href)
                .onSuccess(function(res) {
                    $('[name="level_menu"]').on('change', function(){
                        if(this.value  == 'sub_menu'){
                            $('#main_menu_wrapper').removeClass('d-none')
                        } else {
                            $('#main_menu_wrapper').addClass('d-none')
                        }
                    })



                    handleFormSubmit('#form_action')
                        .onSuccess(function(res) {

                        })
                        .setDataTable('menu-table')
                        .init()
                })
                .execute()
                    
            })

        </script>

    @endpush

</x-master-layout>
