<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue.js</title>

    <!-- token -->
    <meta name="token" content="{{ csrf_token() }}">
    <!-- route -->
    <meta name="route_api" content="{{route('vue.api')}}">



    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        .hidden{
            display:none;
        }
        .bg_light{
            background: #eee;
            color: #aaa;
        }
    </style>


</head>
<body>


    <!-- Main MTML -->
    <div id="app">

        <div class="card" style="width: 30rem;">

            <div v-bind:class="{ hidden : input.hidden }">
            <div class="m-3 d-flex justify-content-between align-items-center">
                {{-- <form> --}}
                    <input @change="changeInput()" type="text" v-model="input.text" id="input">
                    <buttun  @click="postTextbox()" type="button" class="btn btn-secondary">@{{input.submitBtn}}</buttun>
                {{-- </form> --}}

                <button class="btn btn-outline-secondary" type="button"
                    @click="hiddenInput()">テキストボックス選択</button>
            </div>
            </div>


            <ul class="list-group list-group-flush">
                <li v-for="(textbox,index) in textboxes"
                    v-bind:class="{ bg_light : textbox.bgLight }"
                    class="list-group-item d-flex justify-content-between align-items-center"
                    style="min-height:3em;">

                    <div> @{{textbox.value}}</div>
                    <div  v-bind:class="{ hidden : input.textboxBtnsHidden }">
                        <button @click="editTextbox(index)" type="button" class="btn btn-outline-secondary">編集</button>
                        <button @click="deleteTextbox(index)" type="button" class="btn btn-outline-secondary">削除</button>
                        <button @click="createTextbox(index)" type="button" class="btn btn-outline-secondary">挿入</button>
                    </div>

                </li>
            </ul>


        </div>


    </div>




    <!-- Vue.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script>
        (function(){
            'use strict';

            // token
            const token = document.querySelector('meta[name="token"]').content; //トークン(メタタグに保存)
            // route
            const routeApi = document.querySelector('meta[name="route_api"]').content;



            var app = new Vue({


                el: '#app',


                data: {
                    input: {
                        text: '',
                        submitBtn: '',
                        index: 0,
                        hidden: true,
                        textboxBtnsHidden:false,
                        mode:'',
                    },

                    textboxes: [],


                },

                mounted: function(){
                    // this.textboxes = [
                    //     { value: '見出し１', bgLight:false},
                    //     { value: '見出し２', bgLight:false},
                    //     { value: '見出し３', bgLight:false},
                    // ] || [];


                    // 非同期通信
                    fetch(routeApi, {
                        method: 'POST',
                        body: new URLSearchParams({
                            _token: token,
                        }),
                    })
                    .then(response => response.json())
                    .then(json => {
                        console.log(json.textboxes);
                        this.textboxes = json.textboxes;
                    });


                },


                methods:{

                    // 新規挿入フォームの表示
                    createTextbox:function(index){

                        // データの更新
                        this.input.text = '';
                        this.input.submitBtn = '挿入';
                        this.input.index = index+1;
                        this.input.mode = 'create';
                        this.textboxes.forEach(textboxes => {
                            textboxes.bgLight = true;
                        });

                        // 編集中テキストボックスの表示
                        let postData = {value: this.input.text , bgLight:false};
                        this.textboxes.splice(this.input.index,0,postData);

                        // 入力フォームの表示
                        this.input.hidden = false;
                        this.input.textboxBtnsHidden = true;

                    },




                    // 入力フォームに入力された時
                    changeInput:function(){
                        this.textboxes[this.input.index].value = this.input.text;
                    },




                    // 入力フォーム表示の終了
                    hiddenInput:function(){
                        // 編集中テキストボックスの非表示
                        if(this.input.mode === 'create'){
                            this.textboxes.splice(this.input.index,1);
                        }

                        // データの更新
                        this.input.text = '';
                        this.input.index = 0;
                        this.input.mode = '';

                        this.textboxes.forEach(textboxes => {
                            textboxes.bgLight = false;
                        });

                        //入力フォームの非表示
                        this.input.hidden = true;
                        this.input.textboxBtnsHidden = false;

                    },




                    //テキストボックスの挿入or更新
                    postTextbox:function(){

                        // データの更新
                        this.input.text = '';
                        this.input.index = 0;
                        this.input.mode = '';

                        this.textboxes.forEach(textboxes => {
                            textboxes.bgLight = false;
                        });

                        //入力フォームの非表示
                        this.input.hidden = true;
                        this.input.textboxBtnsHidden = false;


                    },




                    // 編集フォームの表示
                    editTextbox(index){

                        // データの更新
                        this.input.text = this.textboxes[index].value;
                        this.input.submitBtn = '更新';
                        this.input.index = index;
                        this.input.mode = 'edit';
                        this.textboxes.forEach( (textboxes,i) => {
                            if(i !== index){
                                textboxes.bgLight = true;
                            }
                        });

                        // 入力フォームの表示
                        this.input.hidden = false;
                        this.input.textboxBtnsHidden = true;

                    },




                    // テキストボックスの削除
                    deleteTextbox:function(index){

                        if(confirm('テキストオックスを削除しますか？')){
                            this.textboxes.splice(index,1);
                        }

                    },
                },


            });




        })();
    </script>


    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
