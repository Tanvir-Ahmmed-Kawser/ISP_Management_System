<style>

.footer{
    width: 100%;
    background: #111827;
    color: white;
    padding: 20px;
    margin-top: 40px;
    box-sizing: border-box;
    border-radius: 10px;
}

.footerContent{
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.footerLogo h2{
    font-size: 22px;
    margin-bottom: 5px;
    color: #38bdf8;
}

.footerLogo p{
    font-size: 14px;
    color: #cbd5e1;
}

.footerLinks{
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.footerLinks a{
    color: #e5e7eb;
    text-decoration: none;
    font-size: 15px;
    transition: 0.3s;
}

.footerLinks a:hover{
    color: #38bdf8;
}

.footerCopy p{
    font-size: 14px;
    color: #cbd5e1;
}

@media(max-width: 768px){

    .footerContent{
        flex-direction: column;
        text-align: center;
    }

    .footerLinks{
        justify-content: center;
    }
}

</style>

<footer class="footer">

    <div class="footerContent">

        <div class="footerLogo">
            <h2>🌐ISP Management System</h2>
            <p>Simple • Fast • Reliable</p>
        </div>

        <div class="footerLinks">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </div>

        <div class="footerCopy">
            <p>© 2026 All Rights Reserved</p>
            <p>Version: 1.1.0</p>
        </div>
    </div>

</footer>