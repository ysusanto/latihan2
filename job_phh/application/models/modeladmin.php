<?php 

class Modeladmin extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	//QUERY berita
	public function getKategoriBerita(){
		$query = $this->db->query("SELECT * FROM kategori_berita ORDER BY nama_kategori ASC");
		return $query;
	}
	
	public function getAllBerita($offset, $limit){
		$query = $this->db->query("
			SELECT p.id as id_berita, p.nama_berita, p.url_title, p.deskripsi, p.file_name, p.id_kategori_berita, p.created_at,
			kp.id, kp.nama_kategori
			FROM berita as p, kategori_berita as kp
			WHERE p.id_kategori_berita = kp.id
			ORDER BY created_at DESC 
			LIMIT $offset, $limit
		");
		return $query;
	}
	
	public function getAllBerita_count(){
		$query = $this->db->query("
			SELECT * FROM berita
		");
		return $query->num_rows();
	}
	
	public function inputBerita($nama_berita, $url_title, $deskripsi, $foto, $kategori){
		$query = $this->db->query("INSERT INTO berita VALUES('', '$nama_berita', '$url_title', '$deskripsi', '$foto', '$kategori', NOW())");
	}
	
	public function getEditBerita($id){
		$query = $this->db->query("
					SELECT p.id as id_berita, p.nama_berita, p.url_title, p.deskripsi, p.file_name, p.id_kategori_berita, p.created_at,
					kp.id, kp.nama_kategori
					FROM berita as p, kategori_berita as kp
					WHERE p.id_kategori_berita = kp.id
					AND p.id = '$id'
					LIMIT 1
					");
		return $query;
	}
	
	public function updateBeritaTanpaFoto($id, $nama_berita, $url_title, $deskripsi, $kategori){
		$query = $this->db->query("UPDATE berita 
									SET nama_berita = '$nama_berita', 
									url_title ='$url_title', 
									deskripsi = '$deskripsi', 
									id_kategori_berita = '$kategori', 
									created_at = NOW()
									WHERE id = '$id'
								");
	}
	
	public function updateBeritaFoto($id, $nama_berita, $url_title, $deskripsi, $foto, $kategori){
		$query = $this->db->query("UPDATE berita 
									SET nama_berita = '$nama_berita', 
									url_title ='$url_title', 
									deskripsi = '$deskripsi', 
									id_kategori_berita = '$kategori', 
									file_name = '$foto', 
									created_at = NOW()
									WHERE id = '$id'
								");
	}
	
	public function hapus_berita($id){
		$this->db->query("DELETE FROM berita WHERE id = '$id' ");
	}
	//END QUERY berita
	
	//QUERY KATEGORI berita
	public function getAllKategoriBerita(){
		$query = $this->db->query("SELECT * FROM kategori_berita ORDER BY created_at DESC");
		return $query;
	}
	
	public function inputKategoriBerita($kategori_berita){
		$this->db->query("INSERT INTO kategori_berita VALUES('', '$kategori_berita', NOW())");
	}
	public function getEditKategoriBerita($id){
		$query = $this->db->query("SELECT * FROM kategori_berita WHERE id = '$id'");
		return $query;
	}
	
	public function updateKategoriBerita($id, $nama_kategori){
		$query = $this->db->query("UPDATE kategori_berita
									SET nama_kategori = '$nama_kategori',
									created_at = NOW()
									WHERE id = '$id'
									
								");
	}
	
	public function getBeritaByIdKategori($id){
		$query = $this->db->query("SELECT * FROM berita WHERE id_kategori_berita = '$id'");
		return $query;
	}
	public function hapusKategori($id){
		$query = $this->db->query("DELETE FROM kategori_berita WHERE id = '$id'");
	}
	//END QUERY KATEGORI berita
	
	//QUERY BANNER
	public function getAllBanner(){
		$query = $this->db->query("SELECT * FROM banner ORDER BY created_at DESC");
		return $query;
	}
	
	public function inputBanner($foto){
		$this->db->query("INSERT INTO banner VALUES('', '$foto', '0', NOW() )");
	}
	
	public function hapusbanner($id){
		$this->db->query("DELETE FROM banner WHERE id = '$id'");
	}
	
	public function getBannerById($id){
		$query = $this->db->query("SELECT * FROM banner WHERE id = '$id'");
		return $query;
	}
	
	public function	updateStatusBanner($id, $status){
		$query = $this->db->query("UPDATE banner 
									SET status = '$status',
									created_at = NOW()
									WHERE id = '$id'
								");
	}
	//END QUERY BANNER

	//QUERY PROFIL	
	public function getProfilByCategory($kategori){
		$query = $this->db->query("SELECT * FROM profil WHERE kategori_profil = '$kategori' ");
		return $query;
	}

	public function getAllProfilCategori(){
		$query = $this->db->query("SELECT * FROM profil ORDER BY id ASC");
		return $query;
	}
	
	public function updateProfil($id, $kategori, $deskripsi){
		$query = $this->db->query("
								UPDATE profil SET deskripsi = '$deskripsi'
								WHERE id = '$id'
								AND kategori_profil = '$kategori'
								");
	}
	//END QUERY PROFIL
	
	//QUERY CONTACT US
	public function getAllContactUs($offset, $limit){
		$query = $this->db->query("SELECT * FROM contact_us ORDER BY created_at DESC LIMIT $offset, $limit");
		return $query;
	}
	public function getAllContactUs_count(){
		$query = $this->db->query("SELECT * FROM contact_us");
		return $query;
	}
	
	public function hapus_contact($id){
		$this->db->query("DELETE FROM contact_us WHERE id = '$id' ");
	}
	
	public function hapus_contact_all($id){
		$this->db->query("DELETE FROM contact_us");
	}
	//END QUERY CONTACT US
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}