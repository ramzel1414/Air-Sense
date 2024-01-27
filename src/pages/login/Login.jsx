import React from 'react';
import './login.css'; // Make sure to import the corresponding CSS file

const Login = () => {
  return (
    <div className="login">
      <div className="row">
        <form action="/dashboard" method="get">
          <h3>Log in with</h3>
          <div class="links">
              <a href="#" class="google"><i class="fab fa-google"></i> Google</a>
              <a href="#" class="facebook"><i class="fab fa-facebook"></i> Facebook</a>
          </div>
          <p className='or'>Or</p>
          <p className="boxLabel">Email Address:</p>
          <input type="email" name="email" className="box" placeholder="enter your email" required maxLength="100" />
          <p className="boxLabel">Password:</p>
          <input type="password" name="name" className="box" placeholder="enter your password" required maxLength="100" />

          <div className="remember">
              <div>
                  <input type="checkbox" name="" id="" /><span>Remember Me</span>
              </div>
              <a href="#">Reset Password</a>
          </div>


          <input type="submit" name="submit" value="login" className="inline-btn boxSubmit" />

          <p className="noACC">Don't have an account yet? <a href="/register"> Register here</a></p>
        </form>

        <div className="image">
          <img src="/assets/images/login.svg" alt="" />
        </div>
      </div>


    </div>
  );
};

export default Login;
