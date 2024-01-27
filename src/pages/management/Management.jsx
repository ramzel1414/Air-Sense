import './management.css'; // Make sure to import the corresponding CSS file
import HeaderAndSidebar from '../../components/headerAndSidebar/HeaderAndSidebar';


const Management = () => {
    return (
        <div>
            < HeaderAndSidebar />
            <section className="management">
                <h1 className="heading">System Management</h1>
                <div className="managementContainer">
                    <div className="addThings">
                    <a href="#" className="addLocation">Add Location</a>
                    <a href="#" className="addDevice">Add Device</a>
                    </div>
                    <p className="recentlyAdded">Recently Added!</p>
                    <div className="recentlyAddedContainer">
                    {[...Array(4)].map((_, index) => (
                        <div className="box" key={index}>
                        <div className="boxDetails">
                            <p>Location: Gaisano Malaybalay</p>
                            <p>Location ID: 12637</p>
                            <p>Sensor Name: Sensor 1</p>
                            <p>Sensor ID: 8080</p>
                            <div className="indented">
                            <p>Particulate Matter2.5: 12ug/m3</p>
                            <p>Particulate Matter10: 150ug/m3</p>
                            <p>Carbon Monoxide: 30ppm</p>
                            <p>Ozone: 300 DU</p>
                            <p>Nitrogen Dioxide: 200ug/m3</p>
                            </div>
                        </div>
                        <div className="boxViewDetails">
                            <a href="#" className='inline-btn'>View Details</a>
                        </div>
                        </div>
                    ))}
                    </div>
                </div>
            </section>
        </div>

    )
}

export default Management;