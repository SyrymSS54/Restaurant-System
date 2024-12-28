import { createRoot} from "react-dom/client";
import App from "./order/app.jsx"

const root = createRoot(document.getElementById('app'));
root.render(<App/>);