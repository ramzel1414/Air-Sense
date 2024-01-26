import React from 'react';
import './headerAndSidebar.css';

import { useState, useEffect } from 'react';

const HeaderAndSidebar = () => {
  const [isProfileActive, setProfileActive] = useState(false);
  const [isSidebarActive, setSidebarActive] = useState(false);  
  

  const handleMenuBtnClick = () => {        //top left side-bar icon
    setSidebarActive(!isSidebarActive);     // Toggle the isSidebarActive state (open/close sidebar)
    document.body.classList.toggle('active', !isSidebarActive);
  };

  const handleCloseBtnClick = () => {       //top left (close btn)
    setSidebarActive(true);
    document.body.classList.toggle('active');
  };

  const handleUserBtnClick = () => {        //top right user icon
    setProfileActive(!isProfileActive);
  };  


  //darkmode start---
  const DarkModeToggle = () => {         
    const [isDarkMode, setDarkMode] = useState(localStorage.getItem('dark-mode') === 'enabled');
  
    const enableDarkMode = () => {
      setDarkMode(true);
      localStorage.setItem('dark-mode', 'enabled');
    };
  
    const disableDarkMode = () => {
      setDarkMode(false);
      localStorage.setItem('dark-mode', 'disabled');
    };
  
    const toggleDarkMode = () => {
      if (isDarkMode) {
        disableDarkMode();
      } else {
        enableDarkMode();
      }
    };
  
    // Add/remove 'dark' class to the body when isDarkMode changes
    useEffect(() => {
      const body = document.body;
      isDarkMode ? body.classList.add('dark') : body.classList.remove('dark');
    }, [isDarkMode]);
  
    return (
      <div id="toggle-btn" className={`fas ${isDarkMode ? 'fa-moon' : 'fa-sun'}`} onClick={toggleDarkMode}></div>
    );
  };

  //darkmode end---






  return (
    <>
        <header className="header">
            <section className="flex">
                <div className="icons airsense">
                    <div id="menu-btn" className={`fas fa-bars ${isSidebarActive ? 'active' : ''}`} onClick={handleMenuBtnClick}></div>
                    <a href="home.html" className="logo">
                        AirSense
                </a>
                </div>

                <form action="" method="post" className="search-form">
                    <input
                        type="text"
                        name="search_box"
                        placeholder="search here..."
                        required
                        maxLength="100"
                    />
                    <button type="submit" className="fas fa-search" name="search_box"></button>
                </form>

                <div className="icons">
                <div id="search-btn" className="fas fa-search"></div>
                <DarkModeToggle /> {/* DarkModeToggle component */}
                <div id="question-btn" className="fas fa-question"></div>
                <div id="user-btn" className="fas fa-user" onClick={handleUserBtnClick}></div>
                <div id="drop-btn" className="fas fa-chevron-down"></div>
                </div>

                <div className={`profile ${isProfileActive ? 'active' : ''}`}>
                <img src="/assets/images/airsense.png" alt="" />
                <h3>Anzai Mitsuyoshi</h3>
                <span>teacher</span>
                <a href="profile.html" className="btn">
                    view profile
                </a>
                <div className="flex-btn">
                    <a href="login.html" className="option-btn">
                    login
                    </a>
                    <a href="register.html" className="option-btn">
                    register
                    </a>
                </div>
                </div>
            </section>
        </header>
        <div className={`side-bar ${isSidebarActive ? 'active' : ''}`}>

            <div className="profile">
            <div className="icons">
                <div id="close-btn" className="fas fa-times" onClick={handleCloseBtnClick}></div>
            </div>
            <img src="/assets/images/airsense.png" alt="Airsense" />
            <h3>Air Pollution</h3>
            <span>monitoring system</span>
            <a href="about.html" className="btn">
                about the airSense
            </a>
            </div>
    
            <nav className="navbar">
            <a href="home.html">
                <i className="fas fa-home"></i>
                <span>home</span>
            </a>
            <a href="about.html">
                <i className="fas fa-question"></i>
                <span>about us</span>
            </a>
            <a href="courses.html">
                <i className="fas fa-graduation-cap"></i>
                <span>courses</span>
            </a>
            <a href="teachers.html">
                <i className="fas fa-chalkboard-user"></i>
                <span>teachers</span>
            </a>
            <a href="contact.html">
                <i className="fas fa-phone"></i>
                <span>contact us</span>
            </a>
            <a href="out.html">
                <i className="fas fa-power-off"></i>
                <span>log out</span>
            </a>
            </nav>
        </div>
      </>
  );
};

export default HeaderAndSidebar;
