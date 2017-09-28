@extends('layouts.app')

@section('content')
 <section class="content-header">
     <h1>
         Dashboard
     </h1>
</section>
{{-- @inject('metrics', 'App\Services\MetricsService') --}}
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="row" id="widget-list">
        @foreach($settings->dashboard_widgets ?? [] as $key => $widget)
            @if((count($widget['config']['roles']) && auth()->user()->hasRole($widget['config']['roles'])) ||
                !count($widget['config']['roles']))
                <div class="widget-item col-sm-{{ $widget['config']['width'] }}" data-id="{{ $key }}">
                    @if(auth()->user()->id == 1)
                        <div class="btn-group pull-right invisible widget-control" style="z-index: 2">
                            <button class="btn btn-sm btn-link">
                                <i class="fa fa-bars fa-lg" style="color:#b0b9bd"></i>
                            </button>
                            <button class="btn btn-sm btn-link js-remove">
                                <i class="fa fa-times fa-lg" style="color:#b0b9bd"></i>
                            </button>
                        </div>
                    @endif
                    @widget($widget['name'], $widget['config'])
                </div>
            @endif
        @endforeach
        @if(auth()->user()->id == 1)
            <div class="col-sm-12">
                <button class="btn btn-default btn-lg btn-flat"
                    data-toggle="modal"
                    data-target="#add-widget">
                    <i class="fa fa-cogs"></i>
                    Manage Widgets
                </button>
                <form @submit.prevent="addWidget">
                    <div class="modal" tabindex="-1" role="dialog" id="add-widget">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Widget</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="widget">Widget</label>
                                        <select required name="widget" v-model="widget.name" id="widget" class="form-control" style="width: 100%">
                                            @foreach(config('laravel-widgets.widgets') as $name => $value)
                                                <option value="{{ $value }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="width">Width</label>
                                        <select required name="width" v-model="widget.width" id="width" class="form-control" style="width: 100%">
                                            <option value="2">2</option>
                                            <option selected value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12 (full width)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="roles">Roles</label>
                                        <select name="roles" id="roles" class="form-control" multiple
                                            v-model="widget.roles">
                                            <option :value="role.name" v-for="role in roles" :key="role.id">@{{ role.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-flat">Add</button>
                                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.6.1/Sortable.min.js"></script>
<script>
    var vm = new Vue({
        el: '.content',
        data: {
            widgets: {!! json_encode($settings->dashboard_widgets) ?? '[]' !!},
            widget: {
                name: '',
                width: '',
                roles: []
            },
            roles: []
        },
        mounted () {
            var self = this
            $("#add-widget").on("hide.bs.modal", function () {
                self.width = {
                    name: '',
                    width: '',
                    roles: []
                }
            })
            this.getRoles()
        },
        methods: {
            addWidget () {
                var widgets = this.widgets ? this.widgets : []
                widgets.push({
                    name: this.widget.name,
                    config: {
                        width: this.widget.width,
                        roles: this.widget.roles,
                    }
                })
                axios.post('/api/settings', {
                    key: 'dashboard_widgets',
                    value: widgets
                }).then(r => {
                    $("#add-widget").modal('toggle')
                    setTimeout(function () {
                        window.location = '/dashboard'
                    }, 300)
                }).catch(e => {
                    alert(e.data.message)
                })
            },
            getRoles () {
                axios.get('/api/roles')
                    .then(r => this.roles = r.data.data)
            },
            updateWidget (widgets) {
                axios.post('/api/settings', {
                    key: 'dashboard_widgets',
                    value: widgets
                }).catch(e => {
                    alert(e.message)
                })
            }
        }
    })
    $(function () {
        $("select").select2('destroy')

        new Sortable($("#widget-list")[0], {
            draggable: '.widget-item',
            filter: '.fa-times',
            handle: '.fa-bars',
            onFilter: function (evt) {
                var el = this.closest(evt.item); // get dragged item
                el && el.parentNode.removeChild(el);
                var sort = this.toArray()
                var widget = vm.widgets
                var new_widget = []

                sort.forEach((v,k) => {
                    new_widget.push(widget[v])
                })

                vm.updateWidget(new_widget)
            },
            onEnd: function (e) {
                var sort = this.toArray()
                var widget = vm.widgets
                var new_widget = []

                sort.forEach((v,k) => {
                    new_widget.push(widget[v])
                })

                vm.updateWidget(new_widget)
            },
        })

        $(".widget-item").hover(function () {
            $(".widget-control", this).css('visibility', 'visible')
        }, function () {
            $(".widget-control", this).css('visibility', 'hidden')
        })
    })
</script>
@endsection
