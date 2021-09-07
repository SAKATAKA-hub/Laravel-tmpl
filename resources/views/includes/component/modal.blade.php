<!--

    * モーダル表示ボタン
    <button class="" type="button" data-toggle="modal" data-target="#modalCenter">button</button>


    * モーダル表示内容の指定
    (@)php
        $modal = [
                'title' => '入力内容の新規登録',
                'body' => 'この内容で新規登録します。</br>よろしいですか？',
        ];
    (@)endphp


    * モーダルサブビューの読み込み
    (@)include('includes.component.modal')

-->




<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <div class="modal-header">
                {{ $modal['title'] }}<!--( title )-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">{{ $modal['body'] }}</div><!--( body )-->


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">はい</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
            </div>
        </div>
    </div>
</div>
