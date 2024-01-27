import './location.css'; // Make sure to import the corresponding CSS file
import HeaderAndSidebar from '../../components/headerAndSidebar/HeaderAndSidebar';

const Location = () => {
    return (
        <div>
            < HeaderAndSidebar />
            <section className="location">
                <h1 className="heading">Location</h1>
                <div className="locationContainer">
                    <div className="locationBox">
                        <div className="locationName">Let</div>
                        <div className="locationImage">
                            <img src="https://64.media.tumblr.com/cda109835d5ec11e2d7969fa55725eca/tumblr_inline_nfz8necoc21skgd1k.jpg" alt="" />
                        </div>
                    </div>
                    <div className="locationBox">
                        <div className="locationName">The</div>
                        <div className="locationImage">
                            <img src="https://64.media.tumblr.com/cda109835d5ec11e2d7969fa55725eca/tumblr_inline_nfz8necoc21skgd1k.jpg" alt="" />
                        </div>
                    </div>
                    <div className="locationBox">
                        <div className="locationName">Guy</div>
                        <div className="locationImage">
                            <img src="https://64.media.tumblr.com/cda109835d5ec11e2d7969fa55725eca/tumblr_inline_nfz8necoc21skgd1k.jpg" alt="" />
                        </div>
                    </div>
                    <div className="locationBox">
                        <div className="locationName">Cook</div>
                        <div className="locationImage">
                            <img src="https://64.media.tumblr.com/cda109835d5ec11e2d7969fa55725eca/tumblr_inline_nfz8necoc21skgd1k.jpg" alt="" />
                        </div>
                    </div>
                </div>
            </section>
        </div>
    )
}

export default Location;