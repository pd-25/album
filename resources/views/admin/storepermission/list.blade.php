@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Store'  )
@section('content')
    <div class="container">
        <div id="app">
            <div class="row">
                <div class="col-12 card shadow">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6>Don't want to give permission to use store</h6>
                            <hr>
                        </div>
                        <div class="col-3" v-for="(us, index) in user" :key="index">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-9 col-form-label">@{{index+1}}. @{{ us.name }}</label>
                                <div class="col-sm-3">
                                  <input type="checkbox" v-model="Checkbox" :value="us.id" v-on:click="AddDontPermission(us.id)">
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    Notiflix.Notify.Init({});
     var app = new Vue({
         el: '#app',
         data: {
            Checkbox:[],
            user:@JSON($user)
        },
        created() {
            this.GetAllPerission();
        },
        methods: {
            AddDontPermission(checkedData){
                let formData = new FormData();
                formData.append('Checkbox', checkedData);
                axios.post('storepermission-store',formData)
                .then(function (response) {
                    app.GetAllPerission();
                    if(response.data == 'Added successfully')
                    {
                        Notiflix.Notify.Success(response.data); 
                    }else{
                        Notiflix.Notify.Failure(response.data);
                    }
                })
                .catch(function (error) {
                    console.log('Error! Could not reach the API Wallpaper Design Adding. ' + error);
                });
            },
            GetAllPerission(){
                axios.get('storepermission/create')
                    .then(function (response) {
                        var finalArr = []
                        response.data.forEach(element => {
                            finalArr.push(element.user_id)
                        });
                        app.Checkbox = finalArr;
                    })
                    .catch(function (error) {
                        console.log('Error! Could not' + error);
                    });
            }
        },
    });
  </script>
@endsection