$content = [System.IO.File]::ReadAllText('C:\Users\user\OneDrive\Xrea\sample020.php', [System.Text.Encoding]::GetEncoding('shift_jis'))
[System.IO.File]::WriteAllText('C:\Users\user\.gemini\antigravity\scratch\T-System-Modern\sample020.php', $content, [System.Text.Encoding]::UTF8)
