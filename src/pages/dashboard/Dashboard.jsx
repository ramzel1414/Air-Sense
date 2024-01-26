import React from 'react';
import './dashboard.css'; // Make sure to import the corresponding CSS file
import HeaderAndSidebar from '../../components/headerAndSidebar/HeaderAndSidebar';

const Dashboard = () => {
  return (
    <div>
      <HeaderAndSidebar/>
      <section className="quick-select">
        <h1 className="heading">overview</h1>
        <div className="box-container">
          {/* Box 1 */}
          <div className="box">
            <h3 className="title">likes and comments</h3>
            <p>total likes : <span>14</span></p>
            <a href="#" className="inline-btn">view likes</a>
            <p>total comments : <span>5</span></p>
            <a href="#" className="inline-btn">view comments</a>
            <p>saved playlist : <span>3</span></p>
            <a href="#" className="inline-btn">view playlist</a>
          </div>
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">top categories</h3>
            <div className="flex">
              <a href="#"><i className="fas fa-code"></i><span>development</span></a>
              {/* Add more category links as needed */}
            </div>
          </div>
          {/* Box 3 */}
          <div className="box">
            <h3 className="title">popular topics</h3>
            <div className="flex">
              <a href="#"><i className="fab fa-html5"></i><span>HTML</span></a>
              {/* Add more topic links as needed */}
            </div>
          </div>
          {/* Box 4 */}
          <div className="box tutor">
            <h3 className="title">become a tutor</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. The quick brown fox jumps. </p>
            <a href="register.html" className="inline-btn">Get Started!</a>
          </div>
        </div>
      </section>


      <section className="employees">
        <h1 className="heading">our employees</h1>
        <div className="box-container">
          {/* Add employee boxes similar to the ones in the HTML */}
        </div>
        <div className="more-btn">
          <a href="courses.html" className="inline-option-btn">view more</a>
        </div>
      </section>
    </div>
  );
};

export default Dashboard;