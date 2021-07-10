<?php


?>

<div class="container-fluid bg-dark p-5">
    <div class="container">
        <form id="filter">
            <div class="row">
                <div class="col-lg-3">
                    <select class="form-control" id="categories">
                        <option value="-1">Default select</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-control">
                        <option>Default select</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <input type="number" class="form-control" id="minSalary" placeholder="Min salary">
                </div>
                <div class="col-lg-2">
                    <input type="number" class="form-control" id="maxSalary" placeholder="Max Salary">
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

    </div>
</div>

<div class="container-fluid p-5">
    <div class="row" id="vacs_1">

    </div>
    <div class="row">
        <div class="col-lg-12 mb-5 d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination" id="page">

                </ul>
            </nav>
        </div>
    </div>
</div>


<script>
    let limit = 10;
    pageSize = 3;
    let start = 1;
    filter = {
        pageSize: 1,
        limit: limit,

    }
    $("#page").hide();
    getCategories();
    getVacancies(filter);


    $("#filter").submit(function (e) {

        formSubmit(e)
    });


    function formSubmit(event) {
        event.preventDefault();
        let categoryId = $("#categories")[0].selectedOptions[0].value
        let minSalary = $("#minSalary")[0].value
        let maxSalary = $("#maxSalary")[0].value
        filter = {
            pageSize: 1,
            limit: limit,
            category: categoryId,
            minSal: minSalary,
            maxSal: maxSalary

        }
        getVacancies(filter);

    }


    function getVacancies(filter) {
        $.post("json/vacancies.php", filter,
            function (data, statuse) {

                if (statuse = 'success') generateCard(JSON.parse(data));
                else generateError();
            }
        )
    }

    function getCategories() {
        $.get("json/position.php",
            function (data, statuse) {

                let pos = JSON.parse(data);
                for (let i = 0; i < pos.length; i++) {

                    $("#categories").append(new Option(pos[i].name, pos[i].id));
                }
            }
        )
    }

    function generateCard(obj) {

        let data = obj.data
        let count = obj.count;
        let element = $("#vacs_1")[0];

        let component = ""
        for (let i = 0; i < data.length; i++) {
            component += ' <div class="col-lg-12 mb-5 ">' +
                '<div class="card container ">' +
                '<div class="row  mx-5">' +
                '<div class="col-sm-9">' +
                '<h5 class="card-title"><a href="">' + data[i].jobTitle + '</a></h5>' +
                '<p class="card-text">' + data[i].name + '</p>' +
                '</div>' +
                '<div class="col-sm-3">' +
                '<h5 class="card-title"><span class="badge badge-success">' + data[i].category + '</span></h5>' +
                '<p>Expires :' + data[i].expireDate + '</p>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        }
        element.innerHTML = component;
        if(count>limit) generatePagination(Math.ceil(count/limit))
    }


    function generateError() {
        let element = $("#vacs_1")[0];
        element.innerHTML = "No data found";

    }


    function  generatePagination(count){
        let content=' <li class="">'+
            '<button class="page-link" onclick="previous()">'+
            '<span aria-hidden="true">&laquo;</span>'+
            ' <span class="sr-only">Previous</span>'+
            '</button>'+
            '</li>';
        for(let i=1; i<=count; i++){
            content+='<li class="page-item"><button class="page-link" onclick="pageBtn('+i+')">'+ i+'</button></li>'
        }
        content +=' <li class="">'+
            '<button class="page-link" onclick="next()">'+
            '<span aria-hidden="true">&raquo;</span>'+
            '  <span class="sr-only">Next</span'+
            '</button>'+
            '</li>'
        $("#page")[0].innerHTML=content;
        showPage(start)

    }

    function  pageBtn(e){
        filter.pageSize=e;
        getVacancies(filter);
    }


     function showPage (page) {
        $("#page").show();
        console.log("ss2")
        $(".page-item").hide();
        $(".page-item").each(function (n) {
            if (n >= pageSize * (page - 1) && n < pageSize * page)
                $(this).show();
        });
    }



   function  previous(){
       console.log("ss1")
       $("#next").removeClass("current");
       $(this).addClass("current");
       if (start != 1) {
           showPage(--start);
       }
   }

   function next(){
       console.log("ss")
       $("#previous").removeClass("current");
       $(this).addClass("current");
       if (start < ($('.page-item').length) / 3) {
           showPage(++start);
       }
   }
</script>