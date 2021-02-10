
document.addEventListener('DOMContentLoaded',()=>{
    document.querySelector('.loading').addEventListener('animationend',(e)=>{
        e.target.remove();
        document.querySelector('.main-view').classList.remove('d-none');
        document.querySelector('.error-box').remove();
    }); 

    

    /*
    <div class="col-2 ">
        <form class="editfixdate w-100 h-100 m-0">
            <input type="hidden" name="fix" value="'.$row_1["fix_date"].'" name="fix">
            <input type="submit" value="Edit" class=" text-center w-100 h-100 btn btn-outline-info">
        </form>
    </div>



    */

    let editforms=document.querySelectorAll('.editfixdate');
    editforms.forEach(form=>{
        form.addEventListener('submit',(e)=>{
            
            let col=e.target.edit.dataset.column;
            let form=e.target;
            let id=e.target.id.value;
            let ans=prompt(`Enter New ${col}`);

            if(ans){
                updatefixdate(form,id,ans,col);
                
                
            }else{
                alert('Enter Valid Informations!.');
                e.preventDefault();
            }
            
            

            
            
        });
    });

    function updatefixdate(form,refid,fixdate,column){
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
                    alert('Fixing Date Updated! ');
                    form.fix.value=ajaxRequest.responseText;
                    return true;
                }else{
                    return false;
                }
                
            }

        }
        let query=`finish.php?ref=${refid}&fix=${fixdate}&col=${column}`;
        ajaxRequest.open('GET',query,true);
        ajaxRequest.send();
        return true;



    }
});