function rsTextSelection()
{
        if (document.getSelection) // older Mozilla versions
        {
                var selectedString = document.getSelection();
        }
        else if (document.all) // MSIE 4+
        {
                var selectedString=document.selection.createRange().text;
        }
        else if (window.getSelection) // recent Mozilla versions
        {
                var selectedString=window.getSelection();
        }
        document.rs_form.selectedhtml.value = selectedString;
        if (document.rs_form.url) {
                if (!document.rs_form.url.value) {
                        if (window.location.href)
                        {
                                document.rs_form.url.value=window.location.href;
                        }
                        else if (document.location.href)
                        {
                                document.rs_form.url.value=document.location.href;
                        }
                }
        }
}

function copyselected()
{
        setTimeout("rsTextSelection()",50);
        return true;
}

function openAndRead() {
        window.open('','rs','width=310,height=120,toolbar=0');
        setTimeout("document.rs_form.submit();",500);
}

document.onmouseup = copyselected;
document.onkeyup = copyselected;
