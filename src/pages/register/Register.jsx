import React from 'react';
import './register.css'; // Make sure to import the corresponding CSS file

const Register = () => {
  return (
    <div className="register">
      <div className="row">
        <form action="" method="post">
          <h3>Register with</h3>
          <div class="links">
              <a href="#" class="google"><i class="fab fa-google"></i> Google</a>
              <a href="#" class="facebook"><i class="fab fa-facebook"></i> Facebook</a>
          </div>
          <p className='or'>Or</p>
          <input type="text" name="fullname" className="box" placeholder="enter your full name" required maxLength="100" autocomplete="off"/>
          <input type="email" name="email" className="box" placeholder="enter your email" required maxLength="100" autocomplete="off"/>
          <input type="text" name="username" className="box" placeholder="enter your user name" required maxLength="100" autocomplete="off"/>
          <input type="password" name="password" className="box" placeholder="enter your password" required maxLength="100" autocomplete="off"/>

          <div className="remember">
            <div>

                <input type="checkbox" name="" id=""/>
                <span> By creating an account you agree to our </span>
                <a href="#">Terms and Services</a>
            </div>
          </div>


          <input type="submit" name="submit" value="register account" className="inline-btn boxSubmit" />

          <p className="noACC">Already have an Account? <a href="/"> Login here</a></p>
        </form>

        <div className="image">
          <img src="/assets/images/register.svg" alt="" />
        </div>
      </div>


    </div>
  );
};

export default Register;
