import { useState } from "react";
import Order from "./order";

export default function App() {
    const status_array = ['order']
    const [statusContent,setStatus] = useState(statusContent[0])

    const OrderContent = () => {
        statusContent !== status_array[0] ? setStatus(statusContent[0]) : ()=>{console.log("Order Status")}
    }

    return(
        <div className="main-container">
            <div className="navbar">
                <ul>
                    <li>
                        <button onClick={OrderContent}>Заказы</button>
                    </li>
                </ul>
            </div>
            <div className="content">
                {
                    statusContent == status_array[0] ? <Order/> : <Error/>
                }
            </div>
        </div>
    )
}