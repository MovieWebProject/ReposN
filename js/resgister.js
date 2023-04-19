let form = document.getElementsByTagName('form')[0] ;

        form.addEventListener('submit', function(e) {
            e.preventDefault() ; // ngăn chuyển trang khi submit form bằng POST

            let first = document.getElementById('first').value ;
            let last = document.getElementById('last').value ;
            let email = document.getElementById('email').value ;
            let user = document.getElementById('user').value ;
            let pass = document.getElementById('pass').value ;

            // if(name === '' || price < 1) 
            //     alert('Vui lòng nhập đầy đủ thông tin !')
            
            fetch('./api/add-account.php', {
                method: 'POST',
                body: new URLSearchParams({ 
                    'first': first,
                    'last': last,
                    'user': user,
                    'email': email,
                    'pass': pass,
                })
            })
            .then(response => response.json())
            .then(json => handleResult(json))
        })

        function handleResult(response)
        {            
            if(response.code === 0)
                alert('Thêm thành công')
                
            window.location = './index.html'
        }