// import React from 'react';

// import { useState } from 'react';
// import Sidebar from './Sidebar';  // Import the Sidebar component

// const Header = () => {
//   const [isProfileActive, setProfileActive] = useState(false);
//   const [isSidebarActive, setSidebarActive] = useState(false);  //from sidebar

//   const handleMenuBtnClick = () => {        //top left
//     setSidebarActive(!isSidebarActive);
//     document.body.classList.toggle('active', isSidebarActive);
//   };

//   const handleUserBtnClick = () => {        //top right
//     setProfileActive(!isProfileActive);
//   };


//   return (
//     <header className="header">
//       <section className="flex">
//         <div className="icons">
//           <div id="menu-btn" className="fas fa-bars" onClick={handleMenuBtnClick}></div>
//           <a href="home.html" className="logo">
//             V.N.H.S.
//           </a>
//         </div>

//         <form action="" method="post" className="search-form">
//           <input
//             type="text"
//             name="search_box"
//             placeholder="search here..."
//             required
//             maxLength="100"
//           />
//           <button type="submit" className="fas fa-search" name="search_box"></button>
//         </form>

//         <div className="icons">
//           <div id="search-btn" className="fas fa-search"></div>
//           <div id="toggle-btn" className="fas fa-sun"></div>
//           <div id="question-btn" className="fas fa-question"></div>
//           <div id="user-btn" className="fas fa-user" onClick={handleUserBtnClick}></div>
//           <div id="drop-btn" className="fas fa-chevron-down"></div>
//         </div>

//         <div className={`profile ${isProfileActive ? 'active' : ''}`}>
//           <img src="./etc/ref ansai.jpg" alt="" />
//           <h3>Anzai Mitsuyoshi</h3>
//           <span>teacher</span>
//           <a href="profile.html" className="btn">
//             view profile
//           </a>
//           <div className="flex-btn">
//             <a href="login.html" className="option-btn">
//               login
//             </a>
//             <a href="register.html" className="option-btn">
//               register
//             </a>
//           </div>
//         </div>
//       </section>
//     </header>
//   );
// };

// export default Header;
