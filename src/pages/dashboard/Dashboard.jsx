import './dashboard.css'; // Make sure to import the corresponding CSS file
import HeaderAndSidebar from '../../components/headerAndSidebar/HeaderAndSidebar';

const Dashboard = () => {
  return (
    <div>
      <HeaderAndSidebar/>

      <section className="employees">
        <h1 className="heading">Predicted Outcome</h1>
        <div className="box-container">
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">PM2.5</h3>
            <div className="circle"> </div>
            <p className="outcome">Good</p>
          </div>
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">PM10</h3>
            <div className="circle"> </div>
            <p className="outcome">Bad</p>
          </div>
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">CO2</h3>
            <div className="circle"> </div>
            <p className="outcome">Good</p>
          </div>
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">NO2</h3>
            <div className="circle"> </div>
            <p className="outcome">Good</p>
          </div>
        </div>
      </section>



      <section className="quick-select">
        <h1 className="heading">overview</h1>
        <div className="box-container">
          {/* Box 1 */}
          <div className="box">
            <div className="flex">
              <a href="#"><i className="fas fa-code"></i><span>PM2.5</span></a>
            </div>
          </div>
          {/* Box 2 */}
          <div className="box">
            {/* <h3 className="title">PM10</h3> */}
            <div className="flex">
              <a href="#"><i className="fas fa-code"></i><span>PM10</span></a>
              {/* Add more category links as needed */}
            </div>
          </div>


          {/* Box 1 */}
          <div className="box">
            <div className="flex">
              <a href="#"><i className="fas fa-code"></i><span>CO2</span></a>
            </div>
          </div>
          {/* Box 2 */}
          <div className="box">
            {/* <h3 className="title">PM10</h3> */}
            <div className="flex">
              <a href="#"><i className="fas fa-code"></i><span>NO2</span></a>
              {/* Add more category links as needed */}
            </div>
          </div>
        </div>
      </section>



    </div>
  );
};

export default Dashboard;