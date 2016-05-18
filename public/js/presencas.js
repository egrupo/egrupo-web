$('#divisao').change(function(){
    console.log('selecionaste'+$('#divisao').val());
    var changed = $('#divisao').val();

    switch(changed){
        case 1://Alcateia
            //hide all. show alcateia
            break;
        case 2://TEs
            //hide all. show tes.
            break;
        case 3://TEx
            //hide all. show tex.
            break;
        case 4://Cla
            //hide all show cla.
            break;
        case 5://Chefia
            //hide all. show chefia
            break;
    }
});