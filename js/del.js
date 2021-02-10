document.addEventListener('DOMContentLoaded',()=>{
    let delbtn=document.querySelector('#del');
    delbtn.addEventListener('click',(e)=>{
        let p=confirm('Are You Sure!');
        if(p){
            let id=e.target.parentElement.peaceid.value;
            if(senddata(id)){
                
                alert('done');
                window.location='./view.php';
            }else{
                
                alert('not done');
                window.location='./view.php';
            }
        }else{
            e.preventDefault();
        }
    });


});
function senddata(pid){
    let ajaxRequest;
    try{
        //opera,firefox,safari
        ajaxRequest=new XMLHttpRequest();
    }catch(e){
        try{
            ajaxRequest=new ActiveXObject('Msxm12.XMLHTTP');

        }catch(e){
            try{
                ajaxRequest=new ActiveXObject('Microsoft.XMLHTTP');
            }catch(e){
                return false;
            }
        }
    }
    ajaxRequest.onreadystatechange=()=>{
        if(ajaxRequest.readyState==4){
            if(ajaxRequest.responseText){
                
                location='./view.php';
            }else{
                return false;
            }
            
        }

    }
    let query=`done.php?peaceid=${pid}`;
    ajaxRequest.open('GET',query,true);
    ajaxRequest.send();
    return true;



}

