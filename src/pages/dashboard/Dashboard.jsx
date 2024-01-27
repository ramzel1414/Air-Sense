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
            <h3 className="title">PM2.5</h3>

          </div>
          {/* Box 2 */}
          <div className="box">
            {/* <h3 className="title">PM10</h3> */}
            <div className="flex">
              <a href="#"><i className="fas fa-code"></i><span>PM10</span></a>
              {/* Add more category links as needed */}
            </div>
          </div>

        </div>
      </section>


      <section className="employees">
        <h1 className="heading">our employees</h1>
        <div className="box-container">
          {/* Box 3 */}
          <div className="box">
            <h3 className="title">popular topics</h3>
            <div className="flex">
              <a href="#"><i className="fab fa-html5"></i><span>HTML</span></a>
            </div>
          </div>
          {/* Box 4 */}
          <div className="box tutor">
            <h3 className="title">become a tutor</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. The quick brown fox jumps. </p>
            <a href="register.html" className="inline-btn">Get Started!</a>
          </div>
        {/* Box 3 */}
        <div className="box">
            <h3 className="title">popular topics</h3>
            <div className="flex">
              <a href="#"><i className="fab fa-html5"></i><span>HTML</span></a>
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
    </div>
  );
};

export default Dashboard;