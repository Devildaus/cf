<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Konsultasi AI</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Chatbot Diabetes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card card-primary card-outline direct-chat direct-chat-primary">
                    <div class="card-header">
                        <h3 class="card-title">Asisten Medis Virtual</h3>
                        <div class="card-tools">
                            <span title="Status" class="badge badge-primary">Online</span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="direct-chat-messages" id="chat-box" style="height: 450px;">
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">AI Assistant</span>
                                    <span class="direct-chat-timestamp float-right">{{ now()->format('H:i') }}</span>
                                </div>
                                <img class="direct-chat-img" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AI">
                                <div class="direct-chat-text">
                                    Halo! Saya asisten khusus Diabetes. Silakan tanyakan gejala, pencegahan, atau pola makan.
                                </div>
                            </div>
                        </div>

                        <div id="loading-indicator" class="text-center p-2" style="display: none;">
                            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                            <small class="text-muted ml-2">Sedang berpikir...</small>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <form id="chat-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" id="user-input" name="message" placeholder="Tulis pertanyaan..." class="form-control" autocomplete="off" required>
                                <span class="input-group-append">
                                    <button type="submit" id="btn-send" class="btn btn-primary">Kirim</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Debugging: Pastikan script berjalan
        console.log("Chatbot Script Loaded...");

        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const btnSend = document.getElementById('btn-send');
        const loadingIndicator = document.getElementById('loading-indicator');

        // PERBAIKAN 2: Fungsi Pengaman Token (Cari di Meta, kalau gagal cari di Form)
        function getCsrfToken() {
            const metaToken = document.querySelector('meta[name="csrf-token"]');
            if (metaToken) return metaToken.getAttribute('content');
            
            const inputToken = document.querySelector('input[name="_token"]');
            if (inputToken) return inputToken.value;

            return '';
        }

        function scrollToBottom() {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function appendUserMessage(message) {
            const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const html = `
                <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">Anda</span>
                        <span class="direct-chat-timestamp float-left">${time}</span>
                    </div>
                    <img class="direct-chat-img" src="{{ asset('dist/img/user2-160x160.jpg') }}" alt="User">
                    <div class="direct-chat-text">${message}</div>
                </div>`;
            chatBox.insertAdjacentHTML('beforeend', html);
            scrollToBottom();
        }

        function appendAIMessage(message) {
            const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const cleanMessage = message ? message.replace(/\n/g, '<br>') : '...';
            const html = `
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">AI Assistant</span>
                        <span class="direct-chat-timestamp float-right">${time}</span>
                    </div>
                    <img class="direct-chat-img" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AI">
                    <div class="direct-chat-text">${cleanMessage}</div>
                </div>`;
            chatBox.insertAdjacentHTML('beforeend', html);
            scrollToBottom();
        }

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            console.log("Tombol kirim ditekan...");

            const message = userInput.value.trim();
            const token = getCsrfToken(); // Ambil token saat submit, bukan saat load

            if (!message) return;
            
            if (!token) {
                alert("Error: Token keamanan tidak ditemukan. Silakan refresh halaman.");
                return;
            }

            // 1. UI Updates
            appendUserMessage(message);
            userInput.value = '';
            userInput.disabled = true;
            btnSend.disabled = true;
            loadingIndicator.style.display = 'block';
            scrollToBottom();

            try {
                // 2. Kirim ke Laravel
                console.log("Mengirim request...");
                const response = await fetch("{{ route('chatbot.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token, 
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: message })
                });

                console.log("Status response:", response.status);

                if (!response.ok) {
                    throw new Error(`HTTP Error: ${response.status}`);
                }

                const data = await response.json();
                console.log("Data diterima:", data);
                
                // 3. Tampilkan Balasan
                loadingIndicator.style.display = 'none';
                
                if(data.reply) {
                    appendAIMessage(data.reply);
                } else {
                    appendAIMessage("Maaf, AI tidak memberikan respon.");
                }

            } catch (error) {
                loadingIndicator.style.display = 'none';
                console.error("Fetch Error:", error);
                // Tampilkan pesan error ke user agar tahu kenapa tidak kembali
                appendAIMessage("⚠️ Gagal terhubung ke server. Pastikan n8n aktif. (Cek Console F12 untuk detail)");
            } finally {
                userInput.disabled = false;
                btnSend.disabled = false;
                userInput.focus();
                scrollToBottom();
            }
        });
    });
</script>