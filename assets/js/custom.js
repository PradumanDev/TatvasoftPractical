$.Pk = {
    submitButton : '',
    init : () => {

       
        $.Pk.initDatePicker('.date-picker');//initialize date-picker
        $.Pk.handleFormSubmit();//inititalise form submit function 
        $.Pk.manageEventList();//showing event data
        $.Pk.removeEvent();//showing event data
        
    },
    removeEvent : () => {
        $('.removeEvent').on('click' , (e) => {
            $.Pk.submitButton = $('#ermsg');
            if(confirm('Are you sure, you want to remove this event?')){
                $.Pk.ajax({
                    method : 'GET',
                    url : baseUrl+'manage_ajax/remove_event',
                    data : {
                        target : $(e.target).attr('data-target')
                    }
                } , (resp) => {
                    // location.reload();
                    $(e.target).closest('tr').remove();
                });
            }
        });
    },
    handleFormSubmit : () => {
        $('[submit-form]').on('click' , (e)=>{
            $.Pk.submitButton = $(e.target);
            let tForm = $(e.target).closest('form');
            let isValidForm = $.Pk.checkValidation(tForm);
            
            if(isValidForm){
                $.Pk.ajax({
                    method : tForm.attr('method'),
                    url : tForm.attr('action'),
                    data : tForm.serialize()
                } , (resp) => {
                    tForm[0].reset();
                    console.log(tForm.attr('redirect'));
                    setTimeout(() => {
                        location.href = tForm.attr('redirect');
                    }, 2000);
                    
                });
            }else{
                $.Pk.manageMessage({
                    status : false,
                    message : 'Please fill the required (*) fields.'
                });
            }
        });
    },
    manageEventList : () => {
        if($('#eventsLists').length){
            //loadingRow : $('#loading')[0].outerHTML,
        }
    },
    manageMessage : (params) =>{
        $('#messageId').remove();
        $.Pk.submitButton.parent().append( `<p id="messageId" class="${params.status?'success-msg':'error-msg'}">${params.message}</p>`);
        setTimeout(() => {
            $('#messageId').remove()
        }, 2000);
    },
    initDatePicker : (t) => {
        $(t).datepicker({
            dateFormat : "yy-mm-dd",
            minDate: new Date()
        });
    },
    checkValidation : (t) => {
        
        let isVlid = true;
        t.find('input, select').each((i , e) => {

            if(e.type == 'radio' && !$('[name="recurrence"]:checked').length){
                $.Pk.manageMessage({
                    status : false,
                    message : 'Please choose recurrence.'
                });
                isVlid = false;
            }
           
            if(['text' , 'select-one'].includes(e.type)){
                if($(e).val() == ''){
                    $(e).addClass('error'); 
                    isVlid = false;
                }else{
                    $(e).removeClass('error');
                }
            }
            
        });
        return isVlid;
    },
    ajax : (params , cb) => {
        let btnTitle = $.Pk.submitButton.html();
        $.Pk.submitButton.html('Processing...')
        
        $.ajax({
            ...params,
            success : (resp) => {
                resp = JSON.parse(resp);
                console.log(resp);
                $.Pk.submitButton.html(btnTitle)

                if(resp.status){
                    cb(resp);
                }
                
                if(resp.message && resp.message != ''){
                    $.Pk.manageMessage({
                        status : resp.status,
                        message : resp.message
                    });
                }
            },
            error : (errResp) => {
                $.Pk.submitButton.html(btnTitle)
                
                
                if(errResp.status && errResp.message != ''){
                    $.Pk.manageMessage({
                        status : true,
                        message : errResp.message
                    });
                }
            }
        });
    }

}

$.Pk.init();