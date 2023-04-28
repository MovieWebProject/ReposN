let submit = document.getElementById("submit")
let tukhoa = document.getElementById("tukhoa").value

function logout() {
    // Gửi yêu cầu xóa session ID khỏi cơ sở dữ liệu
    // ...
    
    // Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính của ứng dụng
    // window.location.href = "login.html"; // hoặc "index.html"
    session_destroy();

  }

submit.addEventListener("click", function(event){

        let name = tukhoa.value
        fetch('./api/find.php?name='+name)
        .then(response => response.json())
        .then(json => handleGetMovie(json))
    
    

})

function handleGetMovie(response)
    {
        let array = response.data 
        let show = document.getElementById("show")
        show.innerHTML = "";
        
        array.forEach(x => {
            let tr = document.createElement('tr')

            tr.innerHTML = 
            `
                <td> ${x.title}</td>
                <td> abc</td>
                <td> zyx</td>
                
            
            `
            show.append(tr)
        })
    }
