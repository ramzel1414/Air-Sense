import './settings.css'; // Make sure to import the corresponding CSS file
import HeaderAndSidebar from '../../components/headerAndSidebar/HeaderAndSidebar';


const Settings = () => {
    return (
        <div>
            < HeaderAndSidebar />
            <section className="settings">
                <h1 className="heading">General Settings</h1>
                <div className="settingsGrid">
                    <div className="firstCol">
                    <h3 className="big">General Settings</h3>
                    <div className="list">
                        <p>Language</p>
                        <a href="#">...</a>
                    </div>
                    <div className="list">
                        <p>Theme</p>
                        <a href="#">...</a>
                    </div>
                    <div className="list">
                        <p>Date & Time</p>
                        <a href="#">...</a>
                    </div>
                    <div className="list">
                        <p>Security</p>
                        <a href="#">...</a>
                    </div>
                    </div>
                    <div className="secondCol">
                    <div className="longRect"></div>
                    <div className="box">
                        <h3 className="big">Notification</h3>
                        <div className="tog">
                            <p>c</p>
                            <div className="con">
                                <p>Weather Update Notification</p>
                            </div>
                        </div>
                        <div className="tog">
                            <p>c</p>
                            <div className="con">
                                <p>Device Update Modification</p>
                            </div>
                        </div>
                        <div className="tog">
                            <p>c</p>
                            <div className="con">
                                <p>Reminders Modification</p>
                            </div>
                        </div>
                    </div>
                    <div className="box">
                        <h3 className="big">Your Storage</h3>
                        <div className="desc">Supervise your drive space in the easiest way</div>
                    </div>
                    <div className="box">
                        <h3 className="big">About</h3>
                        <div className="desc">Welcome to Air Quality Monitoring System! We are committed to providing you with accurate and real-time information about the air you breathe, ensuring that you and your community can make informed decisions about your well-being.</div>
                    </div>
                    </div>
                </div>
            </section>
        </div>

    )
}

export default Settings;