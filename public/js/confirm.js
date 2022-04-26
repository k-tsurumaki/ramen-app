function deleteHandle(event){
    //フォームをいったんストップ
    event.preventDefault();
    if(window.confirm('本当に削除しますか？')){ 
        //OKならフォームを再開
        document.getElementById('delete-form').submit();
    }else{
        alert('削除をキャンセルしました');
    }
}